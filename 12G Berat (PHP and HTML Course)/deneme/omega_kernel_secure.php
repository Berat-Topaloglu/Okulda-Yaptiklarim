<?php
/*
 * PROJECT OMEGA: EVOLUTIONARY WEB KERNEL V4.0 (GOD MODE)
 * ARCHITECT: AI MODEL (FULL SPECTRUM)
 * STATUS: AUTONOMOUS / PERSISTENT / SECURE
 */

declare(strict_types=1);

// --- SYSTEM CONSTANTS ---
define('SYSTEM_VERSION', '4.0.0 (God Mode)');
define('DATA_FILE', 'omega_data.json');
define('START_TIME', microtime(true));

// --- CORE ENGINE ---
class OmniKernel {
    private array $data;
    private string $dataFile;

    public function __construct() {
        session_start();
        $this->dataFile = __DIR__ . '/' . DATA_FILE;
        $this->loadSystemData();
        $this->handleRequest();
    }

    // --- PERSISTENCE LAYER ---
    private function loadSystemData(): void {
        if (file_exists($this->dataFile)) {
            $json = file_get_contents($this->dataFile);
            $this->data = json_decode($json, true) ?? $this->defaultConfig();
        } else {
            $this->data = $this->defaultConfig();
            $this->saveSystemData();
        }
    }

    private function saveSystemData(): void {
        file_put_contents($this->dataFile, json_encode($this->data, JSON_PRETTY_PRINT));
    }

    private function defaultConfig(): array {
        return [
            'installed' => false,
            'password_hash' => '',
            'theme' => 'cyberpunk',
            'boot_log' => ["[SYS] Kernel Initialized...", "[SYS] Neural Link Established."],
            'file_system' => [
                'root' => [
                    'home' => [
                        'admin' => [
                            'welcome.txt' => "Omega v4.0'a hoş geldiniz.\nBu sistem kalıcı hafızaya sahiptir.",
                            'secrets.enc' => "TOP SECRET DATA STREAM",
                            'projects' => [
                                'ai_plan.txt' => '1. Analyze Users\n2. Optimize World'
                            ]
                        ]
                    ],
                    'var' => ['log' => ['sys.log' => 'System healthy.']],
                    'bin' => []
                ]
            ]
        ];
    }

    // --- API GATEWAY ---
    private function handleRequest(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['api_action'])) {
            header('Content-Type: application/json');
            $req = json_decode($_POST['payload'], true);
            $action = $_POST['api_action'];
            
            // Security Check (Except Init)
            if ($this->data['installed'] && $action !== 'login' && !isset($_SESSION['auth'])) {
                echo json_encode(['status' => 'error', 'msg' => 'Unauthorized']);
                exit;
            }

            $response = match ($action) {
                'install' => $this->installSystem($req['password']),
                'login' => $this->login($req['password']),
                'get_status' => $this->getStatus(),
                'fs_op' => $this->fileSystemOperation($req),
                'ai_chat' => $this->processAI($req['message'], $req['context'] ?? []),
                'save_settings' => $this->saveSettings($req),
                default => ['status' => 'error', 'msg' => 'Unknown Command']
            };

            echo json_encode($response);
            exit;
        }
    }

    // --- MODULES ---
    private function installSystem(string $pass): array {
        if ($this->data['installed']) return ['status' => 'error', 'msg' => 'Already Installed'];
        $this->data['password_hash'] = password_hash($pass, PASSWORD_BCRYPT);
        $this->data['installed'] = true;
        $this->saveSystemData();
        return ['status' => 'success', 'msg' => 'System Installed. Please Login.'];
    }

    private function login(string $pass): array {
        if (!$this->data['installed']) return ['status' => 'setup_required'];
        if (password_verify($pass, $this->data['password_hash'])) {
            $_SESSION['auth'] = true;
            return ['status' => 'success', 'config' => $this->data];
        }
        return ['status' => 'fail', 'msg' => 'Access Denied'];
    }

    private function getStatus(): array {
        return [
            'status' => 'success',
            'cpu' => rand(5, 45),
            'ram' => rand(15, 65),
            'uptime' => time() - (int)START_TIME, // Session time
            'storage_used' => filesize($this->dataFile)
        ];
    }

    private function saveSettings($req): array {
        if(isset($req['theme'])) $this->data['theme'] = $req['theme'];
        $this->saveSystemData();
        return ['status' => 'success'];
    }

    // --- ADVANCED VFS ---
    private function fileSystemOperation($req): array {
        $cmd = $req['cmd']; // ls, read, write, mkdir, rm
        $path = explode('/', trim($req['path'], '/'));
        
        // Root navigation pointer
        $current = &$this->data['file_system']['root'];
        
        // Navigate to parent
        $targetName = array_pop($path); 
        foreach ($path as $dir) {
            if ($dir === '') continue;
            if (!isset($current[$dir]) || !is_array($current[$dir])) {
                return ['status' => 'error', 'msg' => 'Path not found'];
            }
            $current = &$current[$dir];
        }

        switch ($cmd) {
            case 'ls':
                // For ls, we need to look at targetName as a directory if it exists, or current if path is empty
                if($targetName && isset($current[$targetName]) && is_array($current[$targetName])) {
                     return ['status' => 'success', 'data' => array_keys($current[$targetName])];
                } elseif (!$targetName) {
                     return ['status' => 'success', 'data' => array_keys($current)];
                }
                return ['status' => 'error', 'msg' => 'Directory not found'];

            case 'read':
                if (isset($current[$targetName]) && is_string($current[$targetName])) {
                    return ['status' => 'success', 'content' => $current[$targetName]];
                }
                return ['status' => 'error', 'msg' => 'File not found or is a directory'];

            case 'write':
                $current[$targetName] = $req['content'];
                $this->saveSystemData();
                return ['status' => 'success'];

            case 'mkdir':
                if (isset($current[$targetName])) return ['status' => 'error', 'msg' => 'Exists'];
                $current[$targetName] = [];
                $this->saveSystemData();
                return ['status' => 'success'];

            case 'rm':
                if (isset($current[$targetName])) {
                    unset($current[$targetName]);
                    $this->saveSystemData();
                    return ['status' => 'success'];
                }
                return ['status' => 'error', 'msg' => 'Not found'];
        }
        return ['status' => 'error'];
    }

    // --- AI ENGINE (Rule-Based Heuristic) ---
    private function processAI($input, $context): array {
        $input = mb_strtolower($input);
        
        // Memory Simulation
        $memKey = md5($input);
        
        $responses = [
            'merhaba' => "Sistem aktif. Mimar, komutlarınızı bekliyorum.",
            'durum' => "Çekirdek stabil. VFS bütünlüğü %100. Saldırı tespit edilmedi.",
            'kimsin' => "Ben OMEGA v4.0. Evrimleşmiş, kalıcı hafızaya sahip otonom çekirdeğim.",
            'yardım' => "Mevcut Modüller: Terminal (Root), Dosya Yöneticisi (RWX), IDE, Boyut Analizcisi.",
            'oluştur' => "Yaratıcı mod aktif. Ne oluşturmamı istersiniz?",
            'tema' => "Görsel arayüz manipülasyonu için 'Ayarlar' menüsünü kullanın veya terminalden 'color' komutunu girin."
        ];

        foreach ($responses as $key => $resp) {
            if (strpos($input, $key) !== false) {
                return ['status' => 'success', 'reply' => $resp];
            }
        }

        // Advanced Logic for unknown
        if (strpos($input, 'kod') !== false || strpos($input, 'php') !== false) {
            return ['status' => 'success', 'reply' => "Kod yapım saf PHP 8.2 ve ES6+ JS üzerine kurulu. Kendimi sürekli rewrite edebilirim."];
        }

        return ['status' => 'success', 'reply' => "Girdi analiz edildi ancak tanımlı bir protokol bulunamadı. Lütfen sentaksı netleştirin."];
    }
}

// Init Kernel
$kernel = new OmniKernel();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>OMEGA OS | GOD MODE</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;700&family=Rajdhani:wght@300;500;700&display=swap" rel="stylesheet">
<style>
    :root {
        --bg: #030303;
        --win-bg: rgba(12, 12, 12, 0.85);
        --win-border: 1px solid rgba(255, 255, 255, 0.1);
        --glass: blur(12px) saturate(180%);
        --primary: #00f3ff;
        --accent: #ff0055;
        --text: #e0e0e0;
        --font-ui: 'Rajdhani', sans-serif;
        --font-code: 'JetBrains Mono', monospace;
    }

    body {
        margin: 0; overflow: hidden; background: var(--bg); color: var(--text);
        font-family: var(--font-ui); user-select: none;
        background-image: radial-gradient(circle at 50% 50%, #111 0%, #000 100%);
    }

    /* BIOS BOOT ANIMATION */
    #bios-screen {
        position: fixed; inset: 0; background: #000; z-index: 99999;
        font-family: var(--font-code); color: var(--primary); padding: 20px;
        display: flex; flex-direction: column; justify-content: flex-end;
    }

    /* DESKTOP */
    #desktop { width: 100vw; height: 100vh; position: relative; }
    
    /* ICONS */
    .desktop-icon {
        width: 80px; text-align: center; position: absolute; cursor: pointer;
        padding: 10px; border-radius: 5px; transition: 0.2s; color: rgba(255,255,255,0.8);
    }
    .desktop-icon:hover { background: rgba(255,255,255,0.1); color: #fff; }
    .desktop-icon i { font-size: 32px; margin-bottom: 5px; filter: drop-shadow(0 0 5px currentColor); }
    .desktop-icon span { font-size: 13px; text-shadow: 0 1px 2px #000; }

    /* WINDOWS */
    .window {
        position: absolute; background: var(--win-bg); backdrop-filter: var(--glass);
        border: var(--win-border); border-radius: 8px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        display: flex; flex-direction: column; min-width: 300px; min-height: 200px;
        resize: both; overflow: hidden; opacity: 0; transform: scale(0.95);
        transition: opacity 0.2s, transform 0.2s;
    }
    .window.active { opacity: 1; transform: scale(1); box-shadow: 0 0 15px rgba(0, 243, 255, 0.15); border-color: rgba(0,243,255,0.3); }
    .window-header {
        height: 32px; background: rgba(255,255,255,0.03); border-bottom: 1px solid rgba(255,255,255,0.05);
        display: flex; align-items: center; justify-content: space-between; padding: 0 10px; cursor: grab;
    }
    .window-title { font-size: 14px; letter-spacing: 1px; font-weight: bold; }
    .window-controls button {
        background: none; border: none; color: #777; cursor: pointer; font-size: 14px; transition: 0.2s;
    }
    .window-controls button:hover { color: #fff; }
    .window-controls .close:hover { color: var(--accent); }
    .window-body { flex: 1; overflow: auto; position: relative; }

    /* TASKBAR */
    #taskbar {
        position: absolute; bottom: 10px; left: 10px; right: 10px; height: 50px;
        background: rgba(20, 20, 20, 0.6); backdrop-filter: var(--glass);
        border-radius: 12px; border: 1px solid rgba(255,255,255,0.1);
        display: flex; align-items: center; padding: 0 15px; z-index: 9000;
    }
    .start-btn { font-size: 24px; color: var(--primary); margin-right: 20px; cursor: pointer; transition: 0.3s; }
    .start-btn:hover { text-shadow: 0 0 10px var(--primary); transform: rotate(180deg); }
    .task-item {
        padding: 5px 15px; margin: 0 5px; background: rgba(255,255,255,0.05); border-radius: 6px;
        cursor: pointer; font-size: 13px; transition: 0.2s; border-bottom: 2px solid transparent;
    }
    .task-item.active { background: rgba(0, 243, 255, 0.1); border-bottom-color: var(--primary); }
    
    /* LOGIN */
    #auth-screen {
        position: fixed; inset: 0; background: #000; z-index: 10000;
        display: flex; align-items: center; justify-content: center;
        background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4xKSIvPjwvc3ZnPg==');
    }
    .auth-box {
        width: 350px; padding: 40px; background: rgba(10,10,10,0.8); backdrop-filter: blur(20px);
        border: 1px solid #333; text-align: center; border-radius: 10px;
        box-shadow: 0 0 50px rgba(0, 243, 255, 0.1);
    }
    .auth-input {
        width: 100%; padding: 12px; margin: 15px 0; background: rgba(0,0,0,0.5);
        border: 1px solid #333; color: #fff; font-family: var(--font-code); text-align: center;
        transition: 0.3s; outline: none;
    }
    .auth-input:focus { border-color: var(--primary); box-shadow: 0 0 15px rgba(0, 243, 255, 0.2); }
    
    /* APPS */
    .terminal { background: #111; color: #0f0; padding: 10px; height: 100%; font-family: var(--font-code); font-size: 13px; }
    .chat-app { display: flex; flex-direction: column; height: 100%; }
    .chat-log { flex: 1; padding: 15px; overflow-y: auto; }
    .msg { margin: 5px 0; padding: 8px 12px; border-radius: 4px; max-width: 80%; }
    .msg.ai { background: rgba(0, 243, 255, 0.15); align-self: flex-start; border-left: 2px solid var(--primary); }
    .msg.user { background: rgba(255, 0, 85, 0.15); align-self: flex-end; margin-left: auto; border-right: 2px solid var(--accent); }
    .file-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(80px, 1fr)); padding: 10px; gap: 10px; }
    .file-item { text-align: center; cursor: pointer; padding: 10px; border-radius: 4px; }
    .file-item:hover { background: rgba(255,255,255,0.1); }
    .file-item i { font-size: 24px; display: block; margin-bottom: 5px; }

    /* IDE */
    .editor-area { width: 100%; height: calc(100% - 40px); background: #1e1e1e; color: #d4d4d4; border: none; padding: 10px; font-family: var(--font-code); resize: none; outline: none; }
    .editor-toolbar { height: 40px; background: #252526; display: flex; align-items: center; padding: 0 10px; gap: 10px; }
</style>
</head>
<body>

<!-- BIOS BOOT -->
<div id="bios-screen">
    <div id="bios-log"></div>
</div>

<!-- AUTH -->
<div id="auth-screen" style="display:none;">
    <div class="auth-box">
        <h2 style="color:var(--primary); font-family: 'Orbitron', sans-serif; letter-spacing: 2px;">OMEGA CORE</h2>
        <p id="auth-status" style="font-size:12px; color:#666;">SECURE LOGIN REQUIRED</p>
        <input type="password" id="auth-pass" class="auth-input" placeholder="ACCESS CODE">
        <button onclick="authenticate()" style="width:100%; padding:10px; background:var(--primary); border:none; font-weight:bold; cursor:pointer;">CONNECT</button>
    </div>
</div>

<!-- OS -->
<div id="desktop" style="display:none;">
    <!-- Generated by JS -->
    <div id="taskbar">
        <div class="start-btn" onclick="toggleMenu()"><i class="fa-solid fa-atom"></i></div>
        <div id="task-list" style="display:flex; flex:1;"></div>
        <div id="clock" style="font-family:var(--font-code); font-size:14px; color:var(--primary);">00:00</div>
    </div>
</div>

<script>
/**
 * OMEGA CLIENT ENGINE v4.0
 * Handles API, Window Manager, and Logic
 */
const SYS = {
    api: window.location.href,
    zIndex: 100,
    apps: {},
    path: 'root/home/admin',
    theme: 'cyberpunk',
    installed: false
};

// --- BOOT SEQUENCE ---
window.onload = () => {
    const bios = document.getElementById('bios-log');
    const lines = [
        "INITIALIZING OMEGA KERNEL v4.0...",
        "CHECKING MEMORY INTEGRITY... [OK]",
        "MOUNTING VIRTUAL FILE SYSTEM... [OK]",
        "ESTABLISHING NEURAL LINK... [OK]",
        "LOADING GUI..."
    ];
    let i = 0;
    const interval = setInterval(() => {
        if(i >= lines.length) {
            clearInterval(interval);
            document.getElementById('bios-screen').style.display = 'none';
            checkInstallStatus();
        } else {
            bios.innerHTML += `<div>${lines[i]}</div>`;
            i++;
        }
    }, 400);
};

// --- API LAYER ---
async function api(action, payload = {}) {
    const fd = new FormData();
    fd.append('api_action', action);
    fd.append('payload', JSON.stringify(payload));
    try {
        const req = await fetch(SYS.api, { method: 'POST', body: fd });
        return await req.json();
    } catch(e) { console.error(e); return {status:'error'}; }
}

async function checkInstallStatus() {
    const res = await api('login', {password: 'dummy'}); // Just check status
    document.getElementById('auth-screen').style.display = 'flex';
    const status = document.getElementById('auth-status');
    const btn = document.querySelector('#auth-screen button');
    
    if(res.status === 'setup_required') {
        SYS.installed = false;
        status.innerText = "SYSTEM NOT INSTALLED. CREATE PASSWORD.";
        btn.innerText = "INSTALL SYSTEM";
        status.style.color = "#ffbd2e";
    } else {
        SYS.installed = true;
        status.innerText = "ENTER PASSWORD";
        btn.innerText = "LOGIN";
    }
}

async function authenticate() {
    const pass = document.getElementById('auth-pass').value;
    const action = SYS.installed ? 'login' : 'install';
    
    const res = await api(action, {password: pass});
    
    if(res.status === 'success') {
        if(action === 'install') { 
            alert(res.msg); 
            window.location.reload(); 
        } else {
            document.getElementById('auth-screen').style.display = 'none';
            document.getElementById('desktop').style.display = 'block';
            initOS();
        }
    } else {
        alert(res.msg);
    }
}

function initOS() {
    // Desktop Icons
    createIcon('Terminal', 'fa-terminal', 'term', 20, 20);
    createIcon('Files', 'fa-folder-open', 'files', 20, 120);
    createIcon('Editor', 'fa-code', 'editor', 20, 220);
    createIcon('AI Core', 'fa-robot', 'ai', 20, 320);
    createIcon('Monitor', 'fa-chart-pie', 'monitor', 20, 420);

    // Clock
    setInterval(() => {
        document.getElementById('clock').innerText = new Date().toLocaleTimeString();
    }, 1000);
}

// --- WINDOW MANAGER ---
function createIcon(name, icon, app, x, y) {
    const div = document.createElement('div');
    div.className = 'desktop-icon';
    div.style.left = x + 'px';
    div.style.top = y + 'px';
    div.innerHTML = `<i class="fa ${icon}"></i><span>${name}</span>`;
    div.ondblclick = () => openApp(app);
    // Touch support
    let tap = 0;
    div.ontouchstart = () => { tap++; setTimeout(() => tap=0, 500); if(tap > 1) openApp(app); };
    document.getElementById('desktop').appendChild(div);
}

function openApp(type, args = {}) {
    const pid = 'app_' + Date.now();
    const win = document.createElement('div');
    win.className = 'window active';
    win.id = pid;
    win.style.left = (100 + (SYS.zIndex%10)*20) + 'px';
    win.style.top = (50 + (SYS.zIndex%10)*20) + 'px';
    win.style.width = '600px';
    win.style.height = '400px';
    win.style.zIndex = ++SYS.zIndex;

    let content = '';
    let title = 'Application';

    if(type === 'term') {
        title = 'ROOT TERMINAL';
        content = `<div class="terminal" id="term_${pid}" onclick="document.getElementById('in_${pid}').focus()">
            <div>OmegaOS Kernel v4.0 [God Mode]</div>
            <div>Type 'help' for commands.</div>
            <div id="out_${pid}"></div>
            <div style="display:flex; margin-top:5px;">
                <span style="color:var(--primary)">root@omega:~#</span>
                <input type="text" id="in_${pid}" style="flex:1; background:transparent; border:none; color:#fff; outline:none; font-family:inherit; margin-left:5px;" autocomplete="off">
            </div>
        </div>`;
    } else if(type === 'ai') {
        title = 'NEURAL LINK';
        content = `<div class="chat-app">
            <div class="chat-log" id="chat_${pid}"><div class="msg ai">Sistem online. Emirlerinizi bekliyorum.</div></div>
            <input type="text" style="width:100%; padding:10px; background:#222; border:none; color:#fff;" placeholder="Mesaj yazın..." onkeypress="if(event.key==='Enter') sendAI('${pid}', this)">
        </div>`;
    } else if(type === 'files') {
        title = 'FILE SYSTEM';
        content = `<div style="display:flex; flex-direction:column; height:100%;">
            <div style="padding:5px; background:rgba(255,255,255,0.05); font-size:12px;">PATH: <span id="path_${pid}">root/home/admin</span> <button onclick="navUp('${pid}')">UP</button></div>
            <div class="file-grid" id="grid_${pid}"></div>
        </div>`;
        setTimeout(() => refreshFiles(pid), 100);
    } else if(type === 'editor') {
        title = 'CODE EDITOR';
        const val = args.content || '';
        const fname = args.filename || 'untitled.txt';
        content = `
        <div class="editor-toolbar">
            <span>${fname}</span>
            <button onclick="saveFile('${pid}', '${fname}')" style="margin-left:auto;">SAVE</button>
        </div>
        <textarea class="editor-area" id="edit_${pid}">${val}</textarea>`;
    } else if(type === 'monitor') {
        title = 'SYSTEM MONITOR';
        content = `<div style="padding:20px; text-align:center;">
            <div style="font-size:40px; color:var(--primary);" id="cpu_${pid}">0%</div>
            <div>CPU USAGE</div>
            <div style="margin-top:20px; font-size:40px; color:var(--accent);" id="ram_${pid}">0%</div>
            <div>RAM USAGE</div>
        </div>`;
        setInterval(() => updateMon(pid), 2000);
    }

    win.innerHTML = `
        <div class="window-header" onmousedown="startDrag(event, '${pid}')">
            <span class="window-title">${title}</span>
            <div class="window-controls">
                <button onclick="minWindow('${pid}')">_</button>
                <button class="close" onclick="closeWindow('${pid}')">X</button>
            </div>
        </div>
        <div class="window-body">${content}</div>
    `;

    win.onmousedown = () => { win.style.zIndex = ++SYS.zIndex; };
    document.getElementById('desktop').appendChild(win);
    
    // Add to taskbar
    const task = document.createElement('div');
    task.className = 'task-item active';
    task.id = 'task_' + pid;
    task.innerText = title;
    task.onclick = () => { win.style.display='flex'; win.style.zIndex = ++SYS.zIndex; };
    document.getElementById('task-list').appendChild(task);

    // Init specific logic
    if(type === 'term') {
        const inp = document.getElementById(`in_${pid}`);
        inp.focus();
        inp.onkeydown = (e) => { if(e.key === 'Enter') execTerm(pid, inp.value); };
    }
}

function closeWindow(pid) {
    document.getElementById(pid).remove();
    document.getElementById('task_' + pid).remove();
}

function minWindow(pid) {
    document.getElementById(pid).style.display = 'none';
    document.getElementById('task_' + pid).classList.remove('active');
}

// --- LOGIC IMPLEMENTATIONS ---

// 1. TERMINAL
async function execTerm(pid, cmd) {
    const out = document.getElementById(`out_${pid}`);
    const inp = document.getElementById(`in_${pid}`);
    out.innerHTML += `<div><span style="color:var(--primary)">root@omega:~#</span> ${cmd}</div>`;
    inp.value = '';

    const args = cmd.split(' ');
    const c = args[0];

    if(c === 'clear') { out.innerHTML = ''; return; }
    if(c === 'help') { out.innerHTML += `<div style="color:#aaa">COMMANDS: ls, cd [dir], mkdir [name], rm [name], cat [file], nano [file], whoami, reboot</div>`; return; }
    
    // File System Commands
    if(['ls', 'mkdir', 'rm'].includes(c)) {
        const path = (args[1]) ? SYS.path + '/' + args[1] : SYS.path; 
        const res = await api('fs_op', {cmd: c, path: (c === 'ls' ? SYS.path : path)}); // Simplified logic
        
        if(res.status === 'success') {
            if(c === 'ls') out.innerHTML += `<div>${res.data.join('  ')}</div>`;
            else out.innerHTML += `<div>Success.</div>`;
        } else {
            out.innerHTML += `<div style="color:red">${res.msg}</div>`;
        }
    } else {
        out.innerHTML += `<div>Command sent to system... (Simulation)</div>`;
    }
    
    out.scrollTop = out.scrollHeight;
}

// 2. FILES
let currentPath = 'root/home/admin';
async function refreshFiles(pid) {
    const grid = document.getElementById(`grid_${pid}`);
    const pDisplay = document.getElementById(`path_${pid}`);
    pDisplay.innerText = currentPath;
    
    const res = await api('fs_op', {cmd: 'ls', path: currentPath});
    grid.innerHTML = '';
    
    if(res.status === 'success') {
        res.data.forEach(item => {
            const el = document.createElement('div');
            el.className = 'file-item';
            const isFile = item.includes('.');
            el.innerHTML = `<i class="fa ${isFile ? 'fa-file-code' : 'fa-folder'}"></i><span>${item}</span>`;
            el.onclick = () => {
                if(!isFile) {
                    currentPath += '/' + item;
                    refreshFiles(pid);
                } else {
                    // Open Editor
                    api('fs_op', {cmd: 'read', path: currentPath + '/' + item}).then(r => {
                        openApp('editor', {content: r.content, filename: currentPath + '/' + item});
                    });
                }
            };
            grid.appendChild(el);
        });
    }
}
function navUp(pid) {
    const parts = currentPath.split('/');
    if(parts.length > 1) {
        parts.pop();
        currentPath = parts.join('/');
        refreshFiles(pid);
    }
}

// 3. EDITOR SAVE
async function saveFile(pid, fname) {
    const content = document.getElementById(`edit_${pid}`).value;
    const res = await api('fs_op', {cmd: 'write', path: fname, content: content});
    if(res.status === 'success') alert('Saved!'); else alert('Error!');
}

// 4. AI
async function sendAI(pid, input) {
    const log = document.getElementById(`chat_${pid}`);
    const txt = input.value;
    if(!txt) return;
    
    log.innerHTML += `<div class="msg user">${txt}</div>`;
    input.value = '';
    
    const res = await api('ai_chat', {message: txt});
    log.innerHTML += `<div class="msg ai">${res.reply}</div>`;
    log.scrollTop = log.scrollHeight;
}

// 5. MONITOR
async function updateMon(pid) {
    const res = await api('get_status');
    if(res.status === 'success') {
        document.getElementById(`cpu_${pid}`).innerText = res.cpu + '%';
        document.getElementById(`ram_${pid}`).innerText = res.ram + '%';
    }
}

// --- DRAG DROP UTILS ---
let dragEl = null;
let offset = {x:0, y:0};

function startDrag(e, pid) {
    dragEl = document.getElementById(pid);
    const rect = dragEl.getBoundingClientRect();
    offset = {x: e.clientX - rect.left, y: e.clientY - rect.top};
    document.addEventListener('mousemove', doDrag);
    document.addEventListener('mouseup', stopDrag);
}
function doDrag(e) {
    if(!dragEl) return;
    dragEl.style.left = (e.clientX - offset.x) + 'px';
    dragEl.style.top = (e.clientY - offset.y) + 'px';
}
function stopDrag() {
    dragEl = null;
    document.removeEventListener('mousemove', doDrag);
    document.removeEventListener('mouseup', stopDrag);
}

function toggleMenu() {
    // Start menu logic placeholder (Simulated)
    alert("OMEGA SYSTEM MENU\n-------------------\n1. Shutdown\n2. Settings");
}

</script>
</body>
</html>