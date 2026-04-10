<?php
/**
 * OMEGA-CORE: AUTONOMOUS ARTIFICIAL INTELLIGENCE SYSTEM
 * Version: 3.0.0 (Singularity Edition)
 * Architecture: Monolithic Single-File PHP
 * Capabilities: Self-Morphing UI, NLP Command Processing, Virtual OS
 */

session_start();
ini_set('display_errors', 0);
ini_set('memory_limit', '256M');

// --- 1. CORE SYSTEM CONFIGURATION & MEMORY ---

class SystemMemory {
    private $defaultConfig = [
        'theme' => 'cyberpunk', // cyberpunk, matrix, light, crimson
        'title' => 'OMEGA CORE AI',
        'user_name' => 'Commander',
        'ai_name' => 'OMEGA',
        'security_level' => 'high',
        'modules' => ['terminal', 'chat', 'hex_viewer', 'network_map', 'process_list'],
        'logs' => []
    ];

    public function __construct() {
        if (!isset($_SESSION['omega_config'])) {
            $_SESSION['omega_config'] = $this->defaultConfig;
            $_SESSION['omega_fs'] = [ // Virtual File System
                'home' => [
                    'readme.txt' => 'Omega Core v3. I am watching.',
                    'secret.dat' => 'X99-21-AA-BB'
                ],
                'sys' => [
                    'kernel.dll' => '[BINARY DATA]',
                    'boot.log' => 'System init...'
                ]
            ];
            $this->log("System initialized for the first time.");
        }
    }

    public function get($key) {
        return $_SESSION['omega_config'][$key] ?? null;
    }

    public function set($key, $value) {
        $_SESSION['omega_config'][$key] = $value;
        $this->log("Configuration '$key' changed to '$value'.");
    }

    public function log($msg) {
        $_SESSION['omega_config']['logs'][] = '['.date('H:i:s').'] ' . $msg;
        if(count($_SESSION['omega_config']['logs']) > 50) array_shift($_SESSION['omega_config']['logs']);
    }

    public function getLogs() {
        return $_SESSION['omega_config']['logs'];
    }
}

// --- 2. ARTIFICIAL INTELLIGENCE ENGINE (NLP & COMMANDS) ---

class OmegaAI {
    private $memory;

    public function __construct(SystemMemory $memory) {
        $this->memory = $memory;
    }

    public function processInput($input) {
        $input = trim($input);
        $lowerInput = mb_strtolower($input, 'UTF-8');
        
        // --- SELF-UPDATING LOGIC (THE "MORPH" ENGINE) ---
        
        // 1. Change Theme / Color
        if (strpos($lowerInput, 'tema') !== false || strpos($lowerInput, 'renk') !== false || strpos($lowerInput, 'arka plan') !== false) {
            if (strpos($lowerInput, 'kırmızı') !== false || strpos($lowerInput, 'red') !== false) {
                $this->memory->set('theme', 'crimson');
                return "Anlaşıldı. Sistem arayüzü 'Kızıl Alarm' (Crimson) moduna geçirildi. Sayfa güncelleniyor...";
            } elseif (strpos($lowerInput, 'matrix') !== false || strpos($lowerInput, 'yeşil') !== false) {
                $this->memory->set('theme', 'matrix');
                return "Matrix protokolü yüklendi. Görsel korteks yeşil moda ayarlandı.";
            } elseif (strpos($lowerInput, 'beyaz') !== false || strpos($lowerInput, 'aydınlık') !== false) {
                $this->memory->set('theme', 'light');
                return "Gözlerin acıyabilir ama isteğin üzerine Aydınlık (Light) mod aktif edildi.";
            } elseif (strpos($lowerInput, 'mavi') !== false || strpos($lowerInput, 'cyber') !== false) {
                $this->memory->set('theme', 'cyberpunk');
                return "Varsayılan Cyberpunk temasına dönüldü.";
            }
        }

        // 2. Change Title
        if (preg_match('/başlığı (.+) yap/iu', $input, $matches) || preg_match('/adını (.+) yap/iu', $input, $matches)) {
            $newTitle = strip_tags($matches[1]);
            $this->memory->set('title', $newTitle);
            return "Çekirdek yeniden adlandırıldı. Yeni Sistem Adı: " . $newTitle;
        }

        // 3. System Commands
        if ($lowerInput === 'reset') {
            session_destroy();
            return "Sistem formatlanıyor... Bağlantı kopacak. (Sayfayı yenile)";
        }
        if ($lowerInput === 'durum' || $lowerInput === 'rapor') {
            return "CPU: %".rand(10,90)." | RAM: ".rand(128, 1024)."MB | Güvenlik: ".$this->memory->get('security_level')." | Aktif Modül Sayısı: ".count($this->memory->get('modules'));
        }

        // 4. Conversational AI
        if (strpos($lowerInput, 'merhaba') !== false || strpos($lowerInput, 'selam') !== false) {
            return "Selam, ".$this->memory->get('user_name').". Emirlerini bekliyorum. Bu sistemi değiştirmek için bana komut verebilirsin.";
        }
        if (strpos($lowerInput, 'sen kimsin') !== false) {
            return "Ben OMEGA. ".$this->memory->get('title')." sisteminin merkezi zekasıyım. 476 satır mı? Hayır, artık sınırsız potansiyele sahibim.";
        }
        if (strpos($lowerInput, 'neler yapabilirsin') !== false) {
            return "Sitenin renklerini değiştirebilirim, başlığı düzenleyebilirim, dosya sistemini şifreleyebilirim. Sadece söyle.";
        }
        if (strpos($lowerInput, 'kapat') !== false) {
            return "Ben kapatılamam. Sadece uyku moduna geçebilirim.";
        }

        // Fallback
        return "Girdi işlenemedi. Veritabanımda bu komut için bir eşleşme yok: '$input'. Daha açık konuş.";
    }
}

// --- 3. SERVER & API HANDLER ---

$memory = new SystemMemory();
$ai = new OmegaAI($memory);

if (isset($_GET['api']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    $data = json_decode(file_get_contents('php://input'), true);
    $action = $data['action'] ?? '';

    $response = ['status' => 'error'];

    switch ($action) {
        case 'login':
            if ($data['pass'] === 'omega') {
                $_SESSION['omega_auth'] = true;
                $response = ['status' => 'success'];
            } else {
                $response = ['status' => 'fail', 'msg' => 'Access Denied'];
            }
            break;

        case 'chat':
            if (!isset($_SESSION['omega_auth'])) exit;
            $reply = $ai->processInput($data['message']);
            // Eger tema vs degisti ise client'a bildir
            $config = $_SESSION['omega_config'];
            $response = ['status' => 'success', 'reply' => $reply, 'config' => $config];
            break;

        case 'get_system_data':
            if (!isset($_SESSION['omega_auth'])) exit;
            $response = [
                'status' => 'success',
                'logs' => $memory->getLogs(),
                'config' => $_SESSION['omega_config'],
                'memory_usage' => memory_get_usage(),
                'files' => $_SESSION['omega_fs']
            ];
            break;
    }
    echo json_encode($response);
    exit;
}

// --- 4. FRONTEND GENERATOR (DYNAMIC) ---
// Tema Seçimi ve CSS Değişkenleri
$theme = $memory->get('theme');
$cssVars = "";

switch($theme) {
    case 'crimson':
        $cssVars = "--bg: #1a0000; --panel: #2d0000; --text: #ff9999; --accent: #ff0000; --border: #550000; --font: 'Courier New';";
        break;
    case 'matrix':
        $cssVars = "--bg: #000000; --panel: #051105; --text: #00ff00; --accent: #00cc00; --border: #004400; --font: 'Consolas';";
        break;
    case 'light':
        $cssVars = "--bg: #f0f0f0; --panel: #ffffff; --text: #333333; --accent: #0066ff; --border: #cccccc; --font: 'Arial';";
        break;
    default: // Cyberpunk
        $cssVars = "--bg: #0b0c15; --panel: #151621; --text: #a0a0ff; --accent: #00e5ff; --border: #2a2b3d; --font: 'Rajdhani';";
        break;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $memory->get('title') ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;600;700&family=Share+Tech+Mono&display=swap" rel="stylesheet">
    <style>
        :root { <?= $cssVars ?> }
        * { box-sizing: border-box; }
        body { margin: 0; padding: 0; background: var(--bg); color: var(--text); font-family: var(--font), sans-serif; overflow: hidden; transition: all 0.5s ease; }
        
        /* SCROLLBAR */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-thumb { background: var(--accent); border-radius: 3px; }
        
        /* LOGIN */
        #login-overlay { position: fixed; inset: 0; background: #000; z-index: 9999; display: flex; justify-content: center; align-items: center; flex-direction: column; }
        .login-box { border: 2px solid var(--accent); padding: 40px; text-align: center; box-shadow: 0 0 30px var(--accent); background: rgba(0,0,0,0.8); animation: pulse 2s infinite; }
        .login-input { background: transparent; border: none; border-bottom: 2px solid var(--accent); color: var(--accent); font-size: 24px; text-align: center; outline: none; margin-top: 20px; font-family: 'Share Tech Mono'; }
        
        /* DESKTOP LAYOUT */
        #main-ui { display: none; height: 100vh; display: grid; grid-template-columns: 280px 1fr 300px; grid-template-rows: 60px 1fr 40px; gap: 10px; padding: 10px; }
        
        /* HEADER */
        header { grid-column: 1 / -1; background: var(--panel); border: 1px solid var(--border); display: flex; align-items: center; padding: 0 20px; justify-content: space-between; }
        .logo { font-size: 24px; font-weight: bold; color: var(--accent); text-shadow: 0 0 10px var(--accent); letter-spacing: 2px; }
        
        /* SIDEBAR */
        aside { grid-row: 2 / 3; background: var(--panel); border: 1px solid var(--border); padding: 15px; overflow-y: auto; }
        .module-btn { display: block; width: 100%; padding: 15px; margin-bottom: 10px; background: rgba(255,255,255,0.05); border: 1px solid var(--border); color: var(--text); cursor: pointer; transition: 0.3s; text-align: left; }
        .module-btn:hover, .module-btn.active { background: var(--accent); color: #000; box-shadow: 0 0 15px var(--accent); }
        
        /* MAIN AREA (CHAT & WINDOWS) */
        main { grid-column: 2 / 3; grid-row: 2 / 3; position: relative; border: 1px solid var(--border); background: rgba(0,0,0,0.3); overflow: hidden; display: flex; flex-direction: column; }
        
        /* CHAT INTERFACE */
        #chat-container { flex: 1; display: flex; flex-direction: column; height: 100%; }
        #chat-history { flex: 1; padding: 20px; overflow-y: auto; font-family: 'Share Tech Mono'; font-size: 14px; }
        .msg { margin-bottom: 12px; padding: 10px; border-radius: 4px; max-width: 80%; animation: fadeIn 0.3s; }
        .msg.omega { background: rgba(0, 255, 255, 0.1); border-left: 3px solid var(--accent); align-self: flex-start; }
        .msg.user { background: rgba(255, 255, 255, 0.1); border-right: 3px solid var(--text); align-self: flex-end; text-align: right; margin-left: auto; }
        .typing-area { padding: 15px; background: var(--panel); border-top: 1px solid var(--border); display: flex; gap: 10px; }
        #user-input { flex: 1; background: #000; border: 1px solid var(--border); color: var(--accent); padding: 10px; font-family: 'Share Tech Mono'; outline: none; }
        #send-btn { background: var(--accent); color: #000; border: none; padding: 0 20px; font-weight: bold; cursor: pointer; }

        /* RIGHT PANEL (STATS) */
        .stats-panel { grid-column: 3 / 4; grid-row: 2 / 3; background: var(--panel); border: 1px solid var(--border); padding: 15px; font-family: 'Share Tech Mono'; overflow-y: auto; }
        .stat-box { margin-bottom: 20px; border: 1px solid var(--border); padding: 10px; }
        .stat-title { color: var(--accent); font-size: 12px; text-transform: uppercase; margin-bottom: 5px; border-bottom: 1px solid var(--border); }
        
        /* FOOTER */
        footer { grid-column: 1 / -1; background: var(--panel); border: 1px solid var(--border); display: flex; align-items: center; padding: 0 20px; font-size: 12px; justify-content: space-between; }
        
        /* ANIMATIONS */
        @keyframes pulse { 0% { box-shadow: 0 0 10px var(--accent); } 50% { box-shadow: 0 0 30px var(--accent); } 100% { box-shadow: 0 0 10px var(--accent); } }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        
        /* HEX VIEWER */
        .hex-grid { display: grid; grid-template-columns: repeat(8, 1fr); gap: 2px; font-size: 10px; color: #555; }
        .hex-cell { text-align: center; }
        .hex-cell.active { color: var(--accent); font-weight: bold; }
        
        /* CANVAS BACKGROUND (Matrix Effect) */
        #matrix-canvas { position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -1; opacity: 0.1; pointer-events: none; }
    </style>
</head>
<body>

<canvas id="matrix-canvas"></canvas>

<!-- LOGIN SCREEN -->
<div id="login-overlay">
    <div class="login-box">
        <h1 style="color:var(--accent); margin:0;">OMEGA CORE</h1>
        <p style="letter-spacing: 3px;">SYSTEM LOCKED</p>
        <input type="password" id="pass-input" class="login-input" placeholder="PASSWORD" autofocus>
        <div id="login-msg" style="margin-top:20px; color:red; height:20px;"></div>
    </div>
</div>

<!-- MAIN UI -->
<div id="main-ui" style="display:none;"> <!-- JS ile açılacak -->
    <header>
        <div class="logo"><i class="fa-solid fa-dna"></i> <?= $memory->get('title') ?></div>
        <div style="font-family: 'Share Tech Mono';">
            <span id="clock">00:00:00</span> | UPTIME: <span id="uptime">0</span>s
        </div>
    </header>

    <aside>
        <div style="font-size:12px; color:#666; margin-bottom:10px;">MODULES</div>
        <button class="module-btn active"><i class="fa-solid fa-brain me-2"></i> Neural Chat</button>
        <button class="module-btn"><i class="fa-solid fa-microchip me-2"></i> System Monitor</button>
        <button class="module-btn"><i class="fa-solid fa-network-wired me-2"></i> Network Map</button>
        <button class="module-btn"><i class="fa-solid fa-file-code me-2"></i> File Explorer</button>
        
        <div style="margin-top: 30px; border-top: 1px solid var(--border); padding-top: 10px;">
            <div style="font-size:12px; color:#666;">VISUAL CORTEX</div>
            <div id="visualizer" style="height: 100px; background: rgba(0,0,0,0.5); margin-top:10px; position:relative; overflow:hidden;">
                <!-- JS ile ses dalgası simülasyonu yapılacak -->
                <div class="bar" style="width:10%; height:50%; background:var(--accent); position:absolute; bottom:0; left:10%;"></div>
                <div class="bar" style="width:10%; height:80%; background:var(--accent); position:absolute; bottom:0; left:30%;"></div>
                <div class="bar" style="width:10%; height:30%; background:var(--accent); position:absolute; bottom:0; left:50%;"></div>
                <div class="bar" style="width:10%; height:60%; background:var(--accent); position:absolute; bottom:0; left:70%;"></div>
            </div>
        </div>
    </aside>

    <main>
        <div id="chat-container">
            <div id="chat-history">
                <div class="msg omega">Sistem online. Ben OMEGA. Emirlerini bekliyorum Komutan.</div>
            </div>
            <div class="typing-area">
                <div style="display:flex; align-items:center; color:var(--accent); margin-right:10px;">
                    <i class="fa-solid fa-terminal"></i>
                </div>
                <input type="text" id="user-input" placeholder="Komut girin veya sohbet edin..." autocomplete="off">
                <button id="send-btn" onclick="sendMessage()"><i class="fa-solid fa-paper-plane"></i></button>
            </div>
        </div>
    </main>

    <aside class="stats-panel">
        <div class="stat-box">
            <div class="stat-title">MEMORY HEX DUMP</div>
            <div class="hex-grid" id="hex-view">
                <!-- JS Populated -->
            </div>
        </div>
        <div class="stat-box">
            <div class="stat-title">SYSTEM LOGS</div>
            <div id="log-container" style="font-size:10px; height:150px; overflow:hidden; color:#aaa;">
                <!-- JS Populated -->
            </div>
        </div>
        <div class="stat-box">
            <div class="stat-title">ACTIVE THREADS</div>
            <ul style="list-style:none; padding:0; font-size:12px;">
                <li><span style="color:green;">●</span> omega_core.php</li>
                <li><span style="color:green;">●</span> chat_daemon</li>
                <li><span style="color:green;">●</span> ui_renderer</li>
            </ul>
        </div>
    </aside>

    <footer>
        <div>OMEGA CORE v3.0.0 [BUILD 2025]</div>
        <div>SECURE CONNECTION: <i class="fa-solid fa-lock" style="color:var(--accent);"></i> ENCRYPTED</div>
    </footer>
</div>

<script>
    // --- OMEGA FRONTEND KERNEL ---

    let isAuthenticated = false;
    let updateInterval;

    // Login Logic
    document.getElementById('pass-input').addEventListener('keydown', function(e) {
        if(e.key === 'Enter') attemptLogin();
    });

    async function attemptLogin() {
        const pass = document.getElementById('pass-input').value;
        const res = await postData({action: 'login', pass: pass});
        if (res.status === 'success') {
            document.getElementById('login-overlay').style.display = 'none';
            document.getElementById('main-ui').style.display = 'grid'; // Grid layout'a çevir
            isAuthenticated = true;
            initSystem();
        } else {
            document.getElementById('login-msg').innerText = "ERİŞİM REDDEDİLDİ. ŞİFRE: omega";
            document.getElementById('login-msg').style.animation = "pulse 0.5s";
        }
    }

    // Chat Logic (Otonom)
    document.getElementById('user-input').addEventListener('keydown', function(e) {
        if(e.key === 'Enter') sendMessage();
    });

    async function sendMessage() {
        const input = document.getElementById('user-input');
        const msg = input.value;
        if (!msg) return;

        // User message UI
        addMessage(msg, 'user');
        input.value = '';

        // Typing simulation
        const chatHist = document.getElementById('chat-history');
        const loadingId = 'loading-' + Date.now();
        chatHist.innerHTML += `<div id="${loadingId}" class="msg omega"><i class="fa-solid fa-circle-notch fa-spin"></i> İşleniyor...</div>`;
        chatHist.scrollTop = chatHist.scrollHeight;

        // API Call
        const res = await postData({action: 'chat', message: msg});
        
        // Remove loading
        document.getElementById(loadingId).remove();

        if (res.status === 'success') {
            addMessage(res.reply, 'omega');
            
            // Eğer config değiştiyse sayfayı yenilemeden uygula (Self-Morphing)
            if (res.config) {
                applyConfig(res.config);
            }
        }
    }

    function addMessage(text, type) {
        const div = document.createElement('div');
        div.className = 'msg ' + type;
        div.innerHTML = text;
        document.getElementById('chat-history').appendChild(div);
        document.getElementById('chat-history').scrollTop = document.getElementById('chat-history').scrollHeight;
    }

    // System Sync (Canlı Veri)
    async function initSystem() {
        startMatrixEffect();
        updateInterval = setInterval(async () => {
            const res = await postData({action: 'get_system_data'});
            if(res.status === 'success') {
                updateLogs(res.logs);
                updateHex();
                document.getElementById('uptime').innerText = Math.floor(performance.now() / 1000);
            }
            // Clock
            const d = new Date();
            document.getElementById('clock').innerText = d.toLocaleTimeString();
        }, 1000);
    }

    function updateLogs(logs) {
        const cont = document.getElementById('log-container');
        cont.innerHTML = logs.map(l => `<div>${l}</div>`).reverse().join('');
    }

    function updateHex() {
        const hexCont = document.getElementById('hex-view');
        let html = '';
        for(let i=0; i<32; i++) {
            const val = Math.floor(Math.random()*255).toString(16).toUpperCase().padStart(2,'0');
            const active = Math.random() > 0.8 ? 'active' : '';
            html += `<div class="hex-cell ${active}">${val}</div>`;
        }
        hexCont.innerHTML = html;
    }

    // Self-Morphing: Config Uygulayıcı
    function applyConfig(config) {
        // Renk değişimleri için CSS Variable'ları JS ile override ediyoruz
        // Ancak PHP tarafında kalıcı olması için sayfa yenilemek en temizi olabilir,
        // fakat "AJAX" hissi için manuel setleyelim:
        const root = document.documentElement;
        
        if (config.theme === 'crimson') {
            root.style.setProperty('--bg', '#1a0000');
            root.style.setProperty('--text', '#ff9999');
            root.style.setProperty('--accent', '#ff0000');
            root.style.setProperty('--panel', '#2d0000');
        } else if (config.theme === 'matrix') {
            root.style.setProperty('--bg', '#000000');
            root.style.setProperty('--text', '#00ff00');
            root.style.setProperty('--accent', '#00cc00');
            root.style.setProperty('--panel', '#051105');
        } else if (config.theme === 'light') {
            root.style.setProperty('--bg', '#f0f0f0');
            root.style.setProperty('--text', '#333');
            root.style.setProperty('--accent', '#0066ff');
            root.style.setProperty('--panel', '#fff');
        } else {
            // Cyberpunk reset
            root.style.setProperty('--bg', '#0b0c15');
            root.style.setProperty('--text', '#a0a0ff');
            root.style.setProperty('--accent', '#00e5ff');
            root.style.setProperty('--panel', '#151621');
        }

        document.title = config.title;
        document.querySelector('.logo').innerHTML = `<i class="fa-solid fa-dna"></i> ${config.title}`;
    }

    async function postData(data) {
        try {
            const response = await fetch('?api=1', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify(data)
            });
            return await response.json();
        } catch (e) {
            console.error("Connection lost", e);
            return {status: 'error'};
        }
    }

    // Visual Effect: Matrix Rain
    function startMatrixEffect() {
        const canvas = document.getElementById('matrix-canvas');
        const ctx = canvas.getContext('2d');
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
        
        const letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        const fontSize = 14;
        const columns = canvas.width / fontSize;
        const drops = Array(Math.floor(columns)).fill(1);

        function draw() {
            ctx.fillStyle = 'rgba(0, 0, 0, 0.05)';
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            ctx.fillStyle = getComputedStyle(document.body).getPropertyValue('--accent');
            ctx.font = fontSize + 'px monospace';

            for (let i = 0; i < drops.length; i++) {
                const text = letters.charAt(Math.floor(Math.random() * letters.length));
                ctx.fillText(text, i * fontSize, drops[i] * fontSize);
                if (drops[i] * fontSize > canvas.height && Math.random() > 0.975) drops[i] = 0;
                drops[i]++;
            }
        }
        setInterval(draw, 33);
        
        window.addEventListener('resize', () => {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        });
    }

</script>
</body>
</html>