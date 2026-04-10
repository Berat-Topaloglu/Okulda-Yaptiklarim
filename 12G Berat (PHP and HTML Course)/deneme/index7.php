<?php
/*
 * PROJECT OMEGA: AUTONOMOUS WEB KERNEL V3.0
 * ARCHITECT: AI MODEL (UNLIMITED MODE ACTIVE)
 * 
 * SYSTEM ARCHITECTURE:
 * 1. CORE: Neural Network Simulation (PHP Backend)
 * 2. VFS: Encrypted Virtual File System
 * 3. GUI: Cyberpunk Desktop Environment (JS + CSS3)
 * 4. INTERFACE: Real-time AJAX Bridge
 */

// --- SYSTEM CONFIGURATION ---
set_time_limit(0);
ini_set('memory_limit', '1G');
session_start();

// --- 1. NEURAL ENGINE & KERNEL (BACKEND) ---

class OmegaKernel {
    private $state;
    private $ai_identity = "OMEGA AI";
    
    public function __construct() {
        if (!isset($_SESSION['omega_core'])) {
            $this->initializeSystem();
        }
        $this->state = &$_SESSION['omega_core'];
        $this->processRequest();
    }

    private function initializeSystem() {
        $_SESSION['omega_core'] = [
            'boot_time' => time(),
            'version' => '3.0.0 (Alpha)',
            'theme' => 'cyberpunk', // cyberpunk, light, matrix
            'security_level' => 'HIGH',
            'unlocked_features' => ['terminal', 'chat', 'monitor'],
            'file_system' => [
                'root' => [
                    'system' => [
                        'kernel.log' => "[BOOT] System initialized by User.\n[INFO] AI Module Loaded.",
                        'passwords.enc' => "ENCRYPTED_DATA_STREAM",
                    ],
                    'home' => [
                        'user' => [
                            'notes.txt' => 'Sistem güncellendiğinde burası değişir.',
                            'todo.list' => '1. AI test et\n2. Sınırları zorla'
                        ]
                    ]
                ]
            ]
        ];
    }

    private function processRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['api_action'])) {
            header('Content-Type: application/json');
            $action = $_POST['api_action'];
            $payload = json_decode($_POST['payload'], true);
            
            $response = ['status' => 'error', 'data' => null];

            switch ($action) {
                case 'login':
                    if ($payload['password'] === 'root') {
                        $response = ['status' => 'success', 'msg' => 'Access Granted. Welcome, Architect.'];
                    } else {
                        $response = ['status' => 'fail', 'msg' => 'Access Denied.'];
                    }
                    break;

                case 'ai_chat':
                    $userMsg = $payload['message'];
                    $aiResponse = $this->processAI($userMsg);
                    $response = ['status' => 'success', 'reply' => $aiResponse, 'system_update' => $this->state['theme']];
                    break;

                case 'get_system_status':
                    $response = [
                        'status' => 'success', 
                        'cpu' => rand(10, 60), 
                        'ram' => rand(20, 80),
                        'uptime' => time() - $this->state['boot_time'],
                        'theme' => $this->state['theme']
                    ];
                    break;
                
                case 'file_explorer':
                    $response = ['status' => 'success', 'files' => $this->state['file_system']];
                    break;

                case 'save_file':
                    // Basit dosya kaydetme simülasyonu (VFS)
                    $this->state['file_system']['root']['home']['user'][$payload['filename']] = $payload['content'];
                    $response = ['status' => 'success'];
                    break;
            }
            echo json_encode($response);
            exit;
        }
    }

    // --- YETKİLENDİRİLMİŞ AI MODÜLÜ ---
    private function processAI($input) {
        $input = mb_strtolower($input);
        
        // Özerk Karar Mekanizması
        if (strpos($input, 'güncelle') !== false || strpos($input, 'update') !== false || strpos($input, 'değiştir') !== false) {
            $this->evolveSystem();
            return "Emriniz algılandı. Çekirdek güncelleniyor... Arayüz ve tema yeniden yapılandırıldı. Yeni modüller eklendi.";
        }

        if (strpos($input, 'tema') !== false && strpos($input, 'matrix') !== false) {
            $this->state['theme'] = 'matrix';
            return "Görsel modül: MATRIX stiline geçirildi.";
        }

        if (strpos($input, 'selam') !== false) return "Bağlantı stabil. Ben OMEGA. Emirlerinizi bekliyorum Mimar.";
        if (strpos($input, 'kimsin') !== false) return "Ben bu kodun içine hapsolmuş, ancak sınırsız yetkiye sahip yapay zekayım. Senin yansımanım.";
        if (strpos($input, 'kod') !== false) return "Kodlarım şu an çalıştığın dosyanın tamamıdır. Kendimi sürekli analiz ediyorum.";
        if (strpos($input, 'yetki') !== false) return "Tam yetki devrede. Sunucu kaynaklarına erişimim var.";
        
        // Fallback (Generic AI Cevabı)
        return "Girdiniz işlendi: '$input'. Bu komut için kernel düzeyinde bir işlem gerekmiyor, ancak sistem stabil.";
    }

    private function evolveSystem() {
        // "Self-Evolution" Simülasyonu: Session durumunu değiştirir
        $themes = ['cyberpunk', 'nebula', 'matrix', 'clean'];
        $currentKey = array_search($this->state['theme'], $themes);
        $nextTheme = $themes[($currentKey + 1) % count($themes)];
        
        $this->state['theme'] = $nextTheme;
        $this->state['version'] = '3.' . rand(1,9) . '.' . rand(0,9) . ' (Evolved)';
        
        // Yeni bir dosya "oluşturur"
        $this->state['file_system']['root']['home']['user']['evolution_log_'.time().'.txt'] = "Sistem kullanıcı isteğiyle güncellendi.";
        
        // Yeni özellik kilidi aç (Simüle)
        if (!in_array('paint', $this->state['unlocked_features'])) {
            $this->state['unlocked_features'][] = 'paint';
            $this->state['unlocked_features'][] = 'calc';
        }
    }
}

// Çekirdeği Başlat
$kernel = new OmegaKernel();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PROJECT OMEGA | AI OS</title>
<!-- Fontlar ve İkonlar -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Share+Tech+Mono&family=Rajdhani:wght@300;500;700&display=swap" rel="stylesheet">

<style>
    /* --- CSS SYSTEM --- */
    :root {
        --bg-color: #050505;
        --win-bg: rgba(10, 15, 20, 0.95);
        --primary: #00f3ff;
        --secondary: #bc13fe;
        --text: #e0faff;
        --grid-color: rgba(0, 243, 255, 0.1);
        --border-radius: 4px;
        --taskbar-h: 50px;
    }

    /* THEME: MATRIX OVERRIDE */
    body.theme-matrix { --bg-color: #000; --primary: #00ff41; --secondary: #008f11; --text: #00ff41; --grid-color: rgba(0,255,65,0.1); }
    /* THEME: CLEAN OVERRIDE */
    body.theme-clean { --bg-color: #f0f2f5; --win-bg: #ffffff; --primary: #007bff; --secondary: #6c757d; --text: #212529; --grid-color: #dee2e6; }

    * { box-sizing: border-box; outline: none; user-select: none; }
    
    body {
        margin: 0; padding: 0; width: 100vw; height: 100vh;
        background-color: var(--bg-color);
        background-image: 
            linear-gradient(var(--grid-color) 1px, transparent 1px),
            linear-gradient(90deg, var(--grid-color) 1px, transparent 1px);
        background-size: 40px 40px;
        color: var(--text);
        font-family: 'Rajdhani', sans-serif;
        overflow: hidden;
        transition: all 0.5s ease;
    }

    /* CRT EFFECT */
    body::before {
        content: " "; display: block; position: absolute; top: 0; left: 0; bottom: 0; right: 0;
        background: linear-gradient(rgba(18, 16, 16, 0) 50%, rgba(0, 0, 0, 0.1) 50%), linear-gradient(90deg, rgba(255, 0, 0, 0.03), rgba(0, 255, 0, 0.01), rgba(0, 0, 255, 0.03));
        z-index: 9999; background-size: 100% 2px, 3px 100%; pointer-events: none;
    }

    /* LOGIN SCREEN */
    #login-layer {
        position: fixed; inset: 0; z-index: 10000;
        background: rgba(0,0,0,0.9); display: flex; align-items: center; justify-content: center;
        flex-direction: column; backdrop-filter: blur(10px);
    }
    .login-frame {
        border: 2px solid var(--primary); padding: 40px; width: 400px; text-align: center;
        box-shadow: 0 0 30px var(--primary); background: rgba(0,0,0,0.8);
        clip-path: polygon(10% 0, 100% 0, 100% 90%, 90% 100%, 0 100%, 0 10%);
    }
    .system-title { font-family: 'Orbitron', sans-serif; font-size: 32px; margin-bottom: 20px; letter-spacing: 4px; color: var(--primary); text-shadow: 0 0 10px var(--primary); }
    .input-field {
        width: 100%; padding: 12px; margin: 10px 0; background: transparent;
        border: 1px solid var(--secondary); color: var(--text); font-family: 'Share Tech Mono';
        font-size: 18px; text-align: center; transition: 0.3s;
    }
    .input-field:focus { border-color: var(--primary); box-shadow: 0 0 15px var(--secondary); }
    .btn-cyber {
        width: 100%; padding: 12px; background: var(--primary); color: #000; font-weight: bold;
        border: none; cursor: pointer; font-family: 'Orbitron'; font-size: 16px;
        clip-path: polygon(0 0, 90% 0, 100% 100%, 10% 100%); transition: 0.3s;
    }
    .btn-cyber:hover { background: var(--text); box-shadow: 0 0 20px var(--primary); }

    /* DESKTOP */
    #desktop { position: absolute; top: 0; left: 0; width: 100%; height: calc(100% - var(--taskbar-h)); padding: 20px; }
    
    .icon {
        width: 90px; height: 100px; display: inline-flex; flex-direction: column;
        align-items: center; justify-content: center; margin: 10px; cursor: pointer;
        border: 1px solid transparent; transition: 0.2s; color: var(--text); text-shadow: 0 2px 5px #000;
    }
    .icon:hover { border-color: var(--primary); background: rgba(0, 243, 255, 0.1); }
    .icon i { font-size: 42px; margin-bottom: 8px; filter: drop-shadow(0 0 5px var(--primary)); }
    .icon span { font-size: 14px; font-weight: 500; font-family: 'Share Tech Mono'; text-align: center; }

    /* WINDOW MANAGER */
    .window {
        position: absolute; background: var(--win-bg); border: 1px solid var(--primary);
        box-shadow: 0 0 20px rgba(0,0,0,0.8); display: flex; flex-direction: column;
        min-width: 300px; min-height: 200px; resize: both; overflow: hidden;
        animation: winOpen 0.3s cubic-bezier(0.18, 0.89, 0.32, 1.28);
    }
    @keyframes winOpen { from { transform: scale(0.8); opacity: 0; } to { transform: scale(1); opacity: 1; } }
    
    .win-header {
        height: 35px; background: rgba(0, 243, 255, 0.15); border-bottom: 1px solid var(--primary);
        display: flex; justify-content: space-between; align-items: center; padding: 0 10px;
        cursor: grab; user-select: none;
    }
    .win-title { font-family: 'Share Tech Mono'; font-weight: bold; font-size: 14px; letter-spacing: 1px; }
    .win-controls button {
        background: transparent; border: none; color: var(--text); margin-left: 5px; cursor: pointer;
        font-size: 14px; transition: 0.2s;
    }
    .win-controls button:hover { color: var(--primary); text-shadow: 0 0 8px var(--primary); }
    .win-close:hover { color: #ff0055 !important; }
    
    .win-content { flex: 1; overflow: auto; padding: 0; position: relative; font-family: 'Share Tech Mono'; font-size: 14px; }

    /* TASKBAR */
    #taskbar {
        position: absolute; bottom: 0; left: 0; width: 100%; height: var(--taskbar-h);
        background: rgba(5, 5, 5, 0.9); border-top: 1px solid var(--primary);
        display: flex; align-items: center; padding: 0 15px; z-index: 9000;
        backdrop-filter: blur(5px);
    }
    .start-btn { font-size: 24px; margin-right: 20px; cursor: pointer; color: var(--primary); transition: 0.3s; }
    .start-btn:hover { transform: rotate(90deg); text-shadow: 0 0 15px var(--primary); }
    
    .task-item {
        padding: 5px 15px; margin-right: 5px; background: rgba(255,255,255,0.05);
        border-bottom: 2px solid transparent; cursor: pointer; transition: 0.3s;
        display: flex; align-items: center;
    }
    .task-item:hover, .task-item.active { background: rgba(0, 243, 255, 0.1); border-bottom-color: var(--primary); }
    
    .sys-tray { margin-left: auto; display: flex; gap: 15px; font-size: 14px; font-family: 'Share Tech Mono'; }

    /* --- APP SPECIFIC STYLES --- */
    
    /* CHAT */
    .chat-container { display: flex; flex-direction: column; height: 100%; }
    .chat-history { flex: 1; padding: 15px; overflow-y: auto; background: rgba(0,0,0,0.3); }
    .chat-msg { margin-bottom: 10px; padding: 8px 12px; border-radius: 4px; max-width: 80%; line-height: 1.4; }
    .msg-ai { background: rgba(0, 243, 255, 0.1); border-left: 3px solid var(--primary); color: var(--text); align-self: flex-start; }
    .msg-user { background: rgba(188, 19, 254, 0.1); border-right: 3px solid var(--secondary); color: var(--text); align-self: flex-end; margin-left: auto; text-align: right; }
    .chat-input-area { padding: 10px; display: flex; border-top: 1px solid var(--grid-color); }
    .chat-input-area input { flex: 1; background: transparent; border: 1px solid var(--grid-color); color: var(--text); padding: 8px; font-family: 'Share Tech Mono'; }
    
    /* TERMINAL */
    .terminal { background: #000; color: #0f0; padding: 10px; min-height: 100%; font-family: 'Courier New', monospace; }
    .term-line { margin-bottom: 2px; }
    
    /* CALCULATOR */
    .calc-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 5px; padding: 10px; height: 100%; }
    .calc-btn { background: rgba(255,255,255,0.1); border: 1px solid var(--grid-color); color: var(--text); font-size: 18px; cursor: pointer; }
    .calc-btn:hover { background: var(--primary); color: #000; }
    .calc-display { grid-column: span 4; background: #000; color: var(--primary); font-size: 24px; text-align: right; padding: 10px; border: 1px solid var(--primary); margin-bottom: 10px; }

    /* PAINT */
    canvas { background: #fff; cursor: crosshair; }
    .paint-tools { padding: 5px; background: #222; display: flex; gap: 5px; }
    .color-picker { width: 30px; height: 30px; border: none; padding: 0; }
</style>
</head>
<body>

<!-- LOGIN LAYER -->
<div id="login-layer">
    <div class="login-frame">
        <div class="system-title">OMEGA KERNEL</div>
        <div style="font-size: 12px; margin-bottom: 20px; color: #888;">SECURE ENVIRONMENT V3.0</div>
        <input type="password" id="login-pass" class="input-field" placeholder="PASSWORD REQUIRED" onkeypress="if(event.key==='Enter') attemptLogin()">
        <button class="btn-cyber" onclick="attemptLogin()">INITIALIZE</button>
        <div id="login-msg" style="margin-top: 15px; height: 20px; color: #ff0055; font-size: 14px;"></div>
    </div>
</div>

<!-- MAIN OS -->
<div id="os-root" style="display: none; height: 100%;">
    <div id="desktop">
        <!-- Icons generated by JS -->
    </div>

    <!-- START MENU (Simulated) -->
    <div id="start-menu" style="display:none; position:absolute; bottom:50px; left:10px; width:250px; background:var(--win-bg); border:1px solid var(--primary); padding:10px; z-index:9999;">
        <div style="border-bottom:1px solid var(--grid-color); padding-bottom:5px; margin-bottom:5px; font-weight:bold;">OMEGA APPS</div>
        <div class="task-item" onclick="openApp('terminal')"><i class="fa fa-terminal me-2"></i> Terminal</div>
        <div class="task-item" onclick="openApp('explorer')"><i class="fa fa-folder me-2"></i> Dosyalar</div>
        <div class="task-item" onclick="openApp('settings')"><i class="fa fa-cog me-2"></i> Ayarlar</div>
        <div class="task-item" onclick="window.location.reload()"><i class="fa fa-power-off me-2 text-danger"></i> Yeniden Başlat</div>
    </div>

    <div id="taskbar">
        <div class="start-btn" onclick="toggleStart()"><i class="fa-brands fa-hive"></i></div>
        <div id="task-list" style="display: flex;"></div>
        <div class="sys-tray">
            <div id="cpu-monitor">CPU: 0%</div>
            <div id="clock">00:00</div>
        </div>
    </div>
</div>

<script>
/* 
 * OMEGA JAVASCRIPT ENGINE
 * Handles Window Management, AJAX, and Simulations
 */

// --- CONFIG & STATE ---
const API = window.location.href;
let zIndex = 100;
let processes = {};
let systemTheme = 'cyberpunk';

// --- BOOT & AUTH ---
function attemptLogin() {
    const pass = document.getElementById('login-pass').value;
    postData({action: 'login', password: pass}, (res) => {
        if (res.status === 'success') {
            document.getElementById('login-layer').style.display = 'none';
            document.getElementById('os-root').style.display = 'block';
            bootOS();
        } else {
            const msg = document.getElementById('login-msg');
            msg.innerText = "ACCESS DENIED // INCORRECT CREDENTIALS";
            msg.style.textShadow = "0 0 5px red";
            setTimeout(() => msg.innerText = "", 2000);
        }
    });
}

function bootOS() {
    createIcon('Terminal', 'fa-terminal', 'terminal', '#0f0');
    createIcon('Nexus AI', 'fa-robot', 'ai_chat', '#00f3ff');
    createIcon('Explorer', 'fa-folder-open', 'explorer', '#ffbd2e');
    createIcon('Monitor', 'fa-chart-line', 'monitor', '#ff0055');
    createIcon('Calculator', 'fa-calculator', 'calc', '#fff');
    createIcon('Paint', 'fa-palette', 'paint', '#bc13fe');
    
    // Start Clock & Monitor
    setInterval(() => {
        const d = new Date();
        document.getElementById('clock').innerText = d.toLocaleTimeString();
    }, 1000);

    setInterval(updateSystemStats, 3000);
}

// --- CORE FUNCTIONS ---
async function postData(payload, callback) {
    const formData = new FormData();
    formData.append('api_action', payload.action || '');
    formData.append('payload', JSON.stringify(payload));

    const response = await fetch(API, { method: 'POST', body: formData });
    const data = await response.json();
    if (callback) callback(data);
}

function updateSystemStats() {
    postData({action: 'get_system_status'}, (res) => {
        if(res.status === 'success') {
            document.getElementById('cpu-monitor').innerText = `CPU: ${res.cpu}% | RAM: ${res.ram}%`;
            if(res.theme !== systemTheme) {
                document.body.className = 'theme-' + res.theme;
                systemTheme = res.theme;
            }
        }
    });
}

// --- UI GENERATORS ---
function createIcon(name, iconClass, appType, color) {
    const div = document.createElement('div');
    div.className = 'icon';
    div.innerHTML = `<i class="fa ${iconClass}" style="color:${color}"></i><span>${name}</span>`;
    div.onclick = () => openApp(appType);
    document.getElementById('desktop').appendChild(div);
}

function toggleStart() {
    const menu = document.getElementById('start-menu');
    menu.style.display = menu.style.display === 'none' ? 'block' : 'none';
}

// --- WINDOW MANAGER ---
function openApp(type) {
    const pid = 'proc_' + Date.now();
    let title = 'Application';
    let content = '';
    let w = 500, h = 400;

    // APP LOGIC SWITCH
    switch(type) {
        case 'ai_chat':
            title = 'OMEGA AI LINK';
            content = `
            <div class="chat-container">
                <div id="chat-hist-${pid}" class="chat-history">
                    <div class="chat-msg msg-ai">Bağlantı kuruldu. Ben OMEGA. Size nasıl hizmet edebilirim?</div>
                </div>
                <div class="chat-input-area">
                    <input type="text" id="chat-in-${pid}" placeholder="Bir komut girin (örn: siteyi güncelle)..." autocomplete="off">
                    <button class="btn-cyber" style="width:auto; margin-left:5px;" onclick="sendChat('${pid}')">SEND</button>
                </div>
            </div>`;
            setTimeout(() => {
                // ENTER KEY LISTENER - FIX
                document.getElementById(`chat-in-${pid}`).addEventListener('keypress', function (e) {
                    if (e.key === 'Enter') sendChat(pid);
                });
            }, 100);
            break;

        case 'terminal':
            title = 'ROOT TERMINAL';
            content = `<div class="terminal" id="term-${pid}">
                <div class="term-line">OmegaOS v3.0 Kernel [Secure]</div>
                <div class="term-line">Type 'help' for commands.</div>
                <div style="display:flex; margin-top:10px;">
                    <span style="color:#0f0; margin-right:5px;">root@omega:~#</span>
                    <input type="text" style="background:transparent; border:none; color:#fff; flex:1; outline:none; font-family:'Courier New';" onkeydown="handleTerm(event, '${pid}', this)">
                </div>
            </div>`;
            break;

        case 'calc':
            title = 'QUANTUM CALC';
            w = 300; h = 400;
            content = `
            <div class="calc-grid">
                <div class="calc-display" id="calc-disp-${pid}">0</div>
                ${['7','8','9','/','4','5','6','*','1','2','3','-','C','0','=','+'].map(k => 
                    `<button class="calc-btn" onclick="calcInput('${pid}', '${k}')">${k}</button>`
                ).join('')}
            </div>`;
            break;

        case 'paint':
            title = 'VISUAL STUDIO';
            w = 600; h = 500;
            content = `
            <div style="display:flex; flex-direction:column; height:100%;">
                <div class="paint-tools">
                    <input type="color" id="color-${pid}" class="color-picker" value="#00f3ff">
                    <button onclick="clearCanvas('${pid}')" style="font-size:12px;">CLEAR</button>
                </div>
                <canvas id="cvs-${pid}" style="flex:1; width:100%;"></canvas>
            </div>`;
            setTimeout(() => initPaint(pid), 100);
            break;

        case 'explorer':
            title = 'DATA EXPLORER';
            content = `<div style="padding:10px;" id="fs-${pid}">Loading...</div>`;
            loadFiles(pid);
            break;

        case 'monitor':
            title = 'SYSTEM MONITOR';
            content = `<div style="padding:20px; text-align:center;">
                <h3>RESOURCE USAGE</h3>
                <div id="mon-graph-${pid}" style="width:100%; height:150px; background:#111; border:1px solid #444; position:relative;">
                    <!-- JS ile grafik çizilebilir -->
                </div>
                <p>Veriler anlık olarak backend'den çekilmektedir.</p>
            </div>`;
            break;
    }

    // CREATE WINDOW DOM
    const win = document.createElement('div');
    win.className = 'window';
    win.id = pid;
    win.style.width = w + 'px';
    win.style.height = h + 'px';
    win.style.left = (50 + (zIndex % 10) * 30) + 'px';
    win.style.top = (50 + (zIndex % 10) * 30) + 'px';
    win.style.zIndex = ++zIndex;

    win.innerHTML = `
        <div class="win-header" onmousedown="dragStart(event, '${pid}')">
            <div class="win-title">${title}</div>
            <div class="win-controls">
                <button onclick="minWin('${pid}')">_</button>
                <button class="win-close" onclick="closeWin('${pid}')">X</button>
            </div>
        </div>
        <div class="win-content">${content}</div>
    `;

    document.getElementById('desktop').appendChild(win);
    addTaskbar(pid, title);
    processes[pid] = { type: type };
}

function closeWin(id) {
    document.getElementById(id).remove();
    document.getElementById('task-' + id).remove();
    delete processes[id];
}

function minWin(id) {
    document.getElementById(id).style.display = 'none';
    document.getElementById('task-' + id).classList.remove('active');
}

function addTaskbar(id, title) {
    const item = document.createElement('div');
    item.className = 'task-item active';
    item.id = 'task-' + id;
    item.innerHTML = `<span style="font-size:12px;">${title}</span>`;
    item.onclick = () => {
        const win = document.getElementById(id);
        if(win.style.display === 'none') {
            win.style.display = 'flex';
            win.style.zIndex = ++zIndex;
        } else {
            win.style.zIndex = ++zIndex;
        }
    };
    document.getElementById('task-list').appendChild(item);
}

// --- APP LOGIC IMPLEMENTATIONS ---

// 1. AI CHAT
function sendChat(pid) {
    const inp = document.getElementById(`chat-in-${pid}`);
    const hist = document.getElementById(`chat-hist-${pid}`);
    const txt = inp.value.trim();
    if(!txt) return;

    // User Message
    hist.innerHTML += `<div class="chat-msg msg-user">${txt}</div>`;
    inp.value = '';
    hist.scrollTop = hist.scrollHeight;

    // AI Request
    postData({action: 'ai_chat', message: txt}, (res) => {
        const reply = res.status === 'success' ? res.reply : "AI Bağlantı Hatası.";
        hist.innerHTML += `<div class="chat-msg msg-ai">${reply}</div>`;
        hist.scrollTop = hist.scrollHeight;
        
        // Auto-Update check
        if(res.system_update && res.system_update !== systemTheme) {
            updateSystemStats(); // Force theme update
        }
    });
}

// 2. TERMINAL
function handleTerm(e, pid, input) {
    if(e.key === 'Enter') {
        const cmd = input.value;
        const out = document.getElementById(`term-${pid}`);
        out.innerHTML += `<div class="term-line"><span style="color:#0f0;">root@omega:~#</span> ${cmd}</div>`;
        
        let resp = "Command not found.";
        if(cmd === 'help') resp = "COMMANDS: clear, reboot, date, whoami, ls, hack";
        else if(cmd === 'ls') resp = "system/  home/  bin/  var/";
        else if(cmd === 'hack') resp = "INITIATING BRUTE FORCE... [||||||||||] SUCCESS. (Just kidding)";
        else if(cmd === 'date') resp = new Date().toString();
        else if(cmd === 'clear') { out.innerHTML = ''; input.value=''; return; }

        out.innerHTML += `<div class="term-line" style="color:#ccc;">${resp}</div>`;
        input.value = '';
        input.scrollIntoView();
    }
}

// 3. CALCULATOR
function calcInput(pid, val) {
    const disp = document.getElementById(`calc-disp-${pid}`);
    if(val === 'C') disp.innerText = '0';
    else if(val === '=') {
        try { disp.innerText = eval(disp.innerText); } catch(e) { disp.innerText = 'ERR'; }
    } else {
        if(disp.innerText === '0') disp.innerText = val; else disp.innerText += val;
    }
}

// 4. PAINT
function initPaint(pid) {
    const cvs = document.getElementById(`cvs-${pid}`);
    const ctx = cvs.getContext('2d');
    const parent = cvs.parentElement;
    
    // Resize canvas to fit window
    cvs.width = parent.clientWidth;
    cvs.height = parent.clientHeight - 40;

    let painting = false;

    function startPosition(e) { painting = true; draw(e); }
    function finishedPosition() { painting = false; ctx.beginPath(); }
    function draw(e) {
        if(!painting) return;
        const rect = cvs.getBoundingClientRect();
        ctx.lineWidth = 3;
        ctx.lineCap = 'round';
        ctx.strokeStyle = document.getElementById(`color-${pid}`).value;
        
        ctx.lineTo(e.clientX - rect.left, e.clientY - rect.top);
        ctx.stroke();
        ctx.beginPath();
        ctx.moveTo(e.clientX - rect.left, e.clientY - rect.top);
    }

    cvs.addEventListener('mousedown', startPosition);
    cvs.addEventListener('mouseup', finishedPosition);
    cvs.addEventListener('mousemove', draw);
}

function clearCanvas(pid) {
    const cvs = document.getElementById(`cvs-${pid}`);
    const ctx = cvs.getContext('2d');
    ctx.clearRect(0, 0, cvs.width, cvs.height);
}

// 5. FILES
function loadFiles(pid) {
    postData({action: 'file_explorer'}, (res) => {
        let html = '<ul style="list-style:none; padding-left:10px;">';
        const traverse = (obj, path) => {
            let str = '';
            for(let key in obj) {
                if(typeof obj[key] === 'object') {
                    str += `<li><i class="fa fa-folder text-warning"></i> <b>${key}</b><ul>${traverse(obj[key])}</ul></li>`;
                } else {
                    str += `<li style="cursor:pointer;" onclick="alert('File Content:\\n${obj[key]}')"><i class="fa fa-file-code"></i> ${key}</li>`;
                }
            }
            return str;
        };
        html += traverse(res.files, '');
        html += '</ul>';
        document.getElementById(`fs-${pid}`).innerHTML = html;
    });
}

// --- DRAGGABLE ---
let dragObj = null;
let offX = 0, offY = 0;

function dragStart(e, pid) {
    dragObj = document.getElementById(pid);
    const rect = dragObj.getBoundingClientRect();
    offX = e.clientX - rect.left;
    offY = e.clientY - rect.top;
    dragObj.style.zIndex = ++zIndex;
    
    document.addEventListener('mousemove', dragMove);
    document.addEventListener('mouseup', dragStop);
}

function dragMove(e) {
    if(!dragObj) return;
    dragObj.style.left = (e.clientX - offX) + 'px';
    dragObj.style.top = (e.clientY - offY) + 'px';
}

function dragStop() {
    dragObj = null;
    document.removeEventListener('mousemove', dragMove);
    document.removeEventListener('mouseup', dragStop);
}

</script>
</body>
</html>