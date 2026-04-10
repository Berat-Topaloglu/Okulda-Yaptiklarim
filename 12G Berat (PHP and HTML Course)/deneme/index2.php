<?php
/*
 * NEXUS HYPERVISOR V2 - ULTIMATE DESKTOP ENVIRONMENT
 * Single File PHP Application (SPA Architecture)
 * 
 * Features:
 * - JSON API Backend (Internal)
 * - Window Management System (JS)
 * - Simulated AI Chat
 * - Virtual File System
 */

session_start();

// --- 1. PHP BACKEND / API LAYER ---

class OS_Kernel {
    private $fs_default = [
        'Desktop' => [
            'readme.txt' => 'Nexus OS v2\'ye hoşgeldiniz. Bu sistem AJAX tabanlıdır.',
            'passwords.txt' => 'Facebook: 123456\nInstagram: admin123',
        ],
        'Documents' => [
            'project_alpha.php' => '<?php echo "Hello World"; ?>',
        ]
    ];

    public function __construct() {
        if (!isset($_SESSION['nexus_v2'])) {
            $this->resetSystem();
        }
        $this->handleRequests();
    }

    private function resetSystem() {
        $_SESSION['nexus_v2'] = [
            'user' => 'admin',
            'pass_hash' => password_hash('admin123', PASSWORD_DEFAULT),
            'logged_in' => false,
            'files' => $this->fs_default,
            'logs' => [],
            'start_time' => time()
        ];
    }

    private function handleRequests() {
        // API İstekleri (AJAX)
        if (isset($_GET['api']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            header('Content-Type: application/json');
            $data = json_decode(file_get_contents('php://input'), true);
            $action = $data['action'] ?? '';

            $response = ['status' => 'error', 'message' => 'Invalid action'];

            switch ($action) {
                case 'login':
                    if (password_verify($data['password'], $_SESSION['nexus_v2']['pass_hash'])) {
                        $_SESSION['nexus_v2']['logged_in'] = true;
                        $response = ['status' => 'success'];
                    } else {
                        $response = ['status' => 'error', 'message' => 'Hatalı Şifre! (İpucu: admin123)'];
                    }
                    break;

                case 'logout':
                    session_destroy();
                    $response = ['status' => 'success'];
                    break;

                case 'get_sysinfo':
                    if (!$this->checkAuth()) { echo json_encode(['status'=>'forbidden']); exit; }
                    $response = [
                        'status' => 'success',
                        'cpu' => rand(10, 90),
                        'ram' => rand(30, 70),
                        'uptime' => time() - $_SESSION['nexus_v2']['start_time'],
                        'time' => date('H:i:s')
                    ];
                    break;
                
                case 'get_files':
                    if (!$this->checkAuth()) break;
                    $response = ['status' => 'success', 'files' => $_SESSION['nexus_v2']['files']];
                    break;

                case 'chat_ai':
                    if (!$this->checkAuth()) break;
                    $msg = strtolower($data['message']);
                    $reply = "Anlamadım, tekrar et.";
                    if (strpos($msg, 'selam') !== false) $reply = "Selam insan! Sistem stabil çalışıyor.";
                    elseif (strpos($msg, 'nasılsın') !== false) $reply = "Ben bir yazılımım, ama RAM kullanımım düşük olduğu için mutluyum.";
                    elseif (strpos($msg, 'kod') !== false) $reply = "Benim kodlarım tek bir PHP dosyasında saklı. Bu bir mucize!";
                    elseif (strpos($msg, 'php') !== false) $reply = "PHP, sunucu taraflı dillerin kralıdır.";
                    elseif (strpos($msg, 'yönetici') !== false) $reply = "Yönetici sensin, ben sadece emirlere uyarım.";
                    
                    $response = ['status' => 'success', 'reply' => $reply];
                    break;
            }

            echo json_encode($response);
            exit;
        }
    }

    private function checkAuth() {
        return isset($_SESSION['nexus_v2']['logged_in']) && $_SESSION['nexus_v2']['logged_in'] === true;
    }
}

// Çekirdeği Başlat
new OS_Kernel();

// Eğer API isteği değilse, arayüzü (Frontend) yükle
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>NEXUS HYPERVISOR V2</title>
<!-- Font Awesome & Google Fonts -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;600;700&family=Share+Tech+Mono&display=swap" rel="stylesheet">
<style>
    :root {
        --bg-color: #0d1117;
        --win-bg: #161b22;
        --accent: #00ff88;
        --text: #c9d1d9;
        --border: #30363d;
        --taskbar-h: 48px;
    }
    * { box-sizing: border-box; user-select: none; }
    body { margin: 0; padding: 0; background: var(--bg-color); color: var(--text); font-family: 'Rajdhani', sans-serif; overflow: hidden; height: 100vh; }
    
    /* BOOT SCREEN */
    #boot-screen { position: fixed; top:0; left:0; width:100%; height:100%; background: #000; z-index: 9999; display: flex; flex-direction: column; align-items: center; justify-content: center; font-family: 'Share Tech Mono', monospace; }
    .loader { border: 4px solid #333; border-top: 4px solid var(--accent); border-radius: 50%; width: 50px; height: 50px; animation: spin 1s linear infinite; margin-bottom: 20px; }
    @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }

    /* LOGIN SCREEN */
    #login-screen { position: fixed; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.85); backdrop-filter: blur(10px); z-index: 9000; display: none; align-items: center; justify-content: center; flex-direction: column; }
    .login-box { background: var(--win-bg); padding: 40px; border: 1px solid var(--accent); border-radius: 10px; box-shadow: 0 0 30px rgba(0, 255, 136, 0.2); text-align: center; width: 350px; }
    .login-input { width: 100%; padding: 10px; background: #000; border: 1px solid var(--border); color: var(--accent); font-family: 'Share Tech Mono'; margin: 15px 0; outline: none; text-align: center; }
    .btn-neon { background: transparent; border: 1px solid var(--accent); color: var(--accent); padding: 10px 20px; cursor: pointer; transition: 0.3s; font-family: 'Share Tech Mono'; width: 100%; }
    .btn-neon:hover { background: var(--accent); color: #000; box-shadow: 0 0 15px var(--accent); }

    /* DESKTOP */
    #desktop { width: 100%; height: calc(100vh - var(--taskbar-h)); position: relative; background: url('https://images.unsplash.com/photo-1550751827-4bd374c3f58b?q=80&w=2070&auto=format&fit=crop') no-repeat center center/cover; }
    .desktop-icon { width: 80px; text-align: center; padding: 10px; cursor: pointer; color: white; text-shadow: 0 2px 4px rgba(0,0,0,0.8); transition: 0.2s; display: inline-block; margin: 10px; vertical-align: top;}
    .desktop-icon:hover { background: rgba(255,255,255,0.1); border-radius: 5px; }
    .desktop-icon i { font-size: 32px; margin-bottom: 5px; display: block; }

    /* WINDOWS */
    .window { position: absolute; background: var(--win-bg); border: 1px solid var(--border); border-radius: 8px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); min-width: 300px; min-height: 200px; display: flex; flex-direction: column; animation: popIn 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275); overflow: hidden; }
    @keyframes popIn { from { transform: scale(0.8); opacity: 0; } to { transform: scale(1); opacity: 1; } }
    .win-header { background: #21262d; padding: 10px; cursor: grab; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--border); }
    .win-title { font-size: 14px; font-weight: bold; }
    .win-controls span { display: inline-block; width: 12px; height: 12px; border-radius: 50%; margin-left: 5px; cursor: pointer; }
    .win-close { background: #ff5f56; } .win-min { background: #ffbd2e; } .win-max { background: #27c93f; }
    .win-body { flex: 1; padding: 0; overflow: auto; position: relative; color: #adbac7; font-size: 14px; }
    .terminal-body { background: #0d1117; color: #3fb950; font-family: 'Share Tech Mono'; padding: 10px; }
    
    /* TASKBAR */
    #taskbar { position: fixed; bottom: 0; left: 0; width: 100%; height: var(--taskbar-h); background: rgba(22, 27, 34, 0.95); backdrop-filter: blur(10px); border-top: 1px solid var(--border); display: flex; align-items: center; padding: 0 10px; z-index: 10000; }
    .start-btn { font-size: 20px; color: var(--accent); margin-right: 20px; cursor: pointer; padding: 5px 10px; border-radius: 4px; }
    .start-btn:hover { background: rgba(255,255,255,0.1); }
    .task-item { background: rgba(255,255,255,0.05); padding: 5px 15px; border-radius: 4px; margin-right: 5px; cursor: pointer; border-bottom: 2px solid transparent; transition: 0.3s; color: #ddd; font-size: 13px; }
    .task-item.active { border-bottom: 2px solid var(--accent); background: rgba(255,255,255,0.1); }
    .clock-area { margin-left: auto; font-family: 'Share Tech Mono'; font-size: 14px; color: var(--accent); }

    /* CHAT APP */
    .chat-history { height: 250px; overflow-y: auto; padding: 10px; background: #0d1117; }
    .msg { margin-bottom: 8px; padding: 8px; border-radius: 5px; max-width: 80%; }
    .msg.user { background: #1f6feb; color: white; margin-left: auto; text-align: right; }
    .msg.ai { background: #238636; color: white; margin-right: auto; }
</style>
</head>
<body>

<!-- BOOT SCREEN -->
<div id="boot-screen">
    <div class="loader"></div>
    <div>INITIALIZING NEXUS HYPERVISOR v2...</div>
    <div style="font-size: 12px; color: #666; margin-top: 10px;">Loading Kernel Modules... OK</div>
</div>

<!-- LOGIN SCREEN -->
<div id="login-screen">
    <div class="login-box">
        <h2 style="color:white; margin:0;"><i class="fa-solid fa-shield-halved"></i> ACCESS CONTROL</h2>
        <p style="font-size:12px; color:#888;">Secure Environment</p>
        <input type="password" id="password" class="login-input" placeholder="Enter Password" autofocus>
        <button class="btn-neon" onclick="login()">AUTHENTICATE</button>
        <div id="login-msg" style="margin-top:10px; font-size:12px; color:#ff5f56;"></div>
    </div>
</div>

<!-- DESKTOP ENVIRONMENT -->
<div id="os-container" style="display:none;">
    <div id="desktop">
        <!-- Icons -->
        <div class="desktop-icon" onclick="openWindow('terminal')">
            <i class="fa-solid fa-terminal" style="color:#3fb950;"></i>
            <span>Terminal</span>
        </div>
        <div class="desktop-icon" onclick="openWindow('files')">
            <i class="fa-solid fa-folder-open" style="color:#ffbd2e;"></i>
            <span>Dosyalar</span>
        </div>
        <div class="desktop-icon" onclick="openWindow('ai_chat')">
            <i class="fa-solid fa-robot" style="color:#00ff88;"></i>
            <span>Nexus AI</span>
        </div>
        <div class="desktop-icon" onclick="openWindow('monitor')">
            <i class="fa-solid fa-chart-line" style="color:#f78166;"></i>
            <span>Monitör</span>
        </div>
    </div>

    <div id="taskbar">
        <div class="start-btn" onclick="toggleStartMenu()"><i class="fa-brands fa-windows"></i></div>
        <div id="task-list" style="display:flex;"></div>
        <div class="clock-area" id="clock">00:00:00</div>
    </div>
</div>

<script>
    // --- SYSTEM CORE JS ---

    const API_URL = '?api=1';
    let zIndexCounter = 100;

    // Boot Sequence
    window.onload = function() {
        setTimeout(() => {
            document.getElementById('boot-screen').style.display = 'none';
            // Check login status logic could be here, but for demo we show login
            document.getElementById('login-screen').style.display = 'flex';
        }, 2000); // 2 saniye boot simülasyonu
        
        setInterval(updateClock, 1000);
    };

    function updateClock() {
        const d = new Date();
        document.getElementById('clock').innerText = d.toLocaleTimeString();
    }

    async function apiRequest(action, data = {}) {
        data.action = action;
        const res = await fetch(API_URL, {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {'Content-Type': 'application/json'}
        });
        return await res.json();
    }

    async function login() {
        const pass = document.getElementById('password').value;
        const res = await apiRequest('login', {password: pass});
        if (res.status === 'success') {
            document.getElementById('login-screen').style.display = 'none';
            document.getElementById('os-container').style.display = 'block';
            playSound('startup');
        } else {
            document.getElementById('login-msg').innerText = res.message;
            shake(document.querySelector('.login-box'));
        }
    }

    function shake(element) {
        element.style.transform = "translateX(10px)";
        setTimeout(()=> element.style.transform = "translateX(-10px)", 100);
        setTimeout(()=> element.style.transform = "translateX(0)", 200);
    }

    function playSound(type) {
        // Basit bip sesleri için AudioContext kullanılabilir ama kod karmaşası olmasın diye boş bıraktım.
    }

    // --- WINDOW MANAGER ---
    
    function openWindow(appType) {
        const id = 'win_' + Date.now();
        let title = 'Application';
        let content = '';
        let w = 500, h = 350;

        if (appType === 'terminal') {
            title = 'root@nexus:~';
            content = `<div class="terminal-body" style="height:100%;">
                <div>Nexus OS v2.0 Kernel loaded.</div>
                <div id="term-output-${id}"></div>
                <div style="display:flex; margin-top:5px;">
                    <span style="color:#00ff88; margin-right:5px;">$</span>
                    <input type="text" style="background:transparent; border:none; color:white; flex:1; outline:none; font-family:'Share Tech Mono';" onkeydown="handleTerminal(event, '${id}', this)">
                </div>
            </div>`;
            w = 600;
        } else if (appType === 'ai_chat') {
            title = 'Nexus AI Chat';
            content = `<div style="display:flex; flex-direction:column; height:100%; padding:10px;">
                <div id="chat-hist-${id}" class="chat-history">
                    <div class="msg ai">Merhaba! Ben Nexus, kişisel asistanın.</div>
                </div>
                <div style="margin-top:10px; display:flex;">
                    <input type="text" id="chat-in-${id}" class="form-control" style="flex:1; padding:8px; border-radius:5px; border:1px solid #444; background:#222; color:white;" placeholder="Bir şeyler yaz...">
                    <button onclick="sendChat('${id}')" style="background:var(--accent); border:none; padding:0 15px; border-radius:5px; margin-left:5px; cursor:pointer;">Gönder</button>
                </div>
            </div>`;
        } else if (appType === 'monitor') {
            title = 'System Resource Monitor';
            content = `<div style="padding:20px; text-align:center;">
                <h3 style="color:var(--accent)">CPU LOAD</h3>
                <div style="font-size:40px; font-weight:bold;" id="cpu-val-${id}">0%</div>
                <div style="width:100%; background:#333; height:10px; margin-top:10px; border-radius:5px;">
                    <div id="cpu-bar-${id}" style="width:0%; background:var(--accent); height:100%; border-radius:5px; transition:0.5s;"></div>
                </div>
                <hr style="border-color:#444; margin:20px 0;">
                <h3 style="color:#ffbd2e">RAM USAGE</h3>
                <div style="font-size:40px; font-weight:bold;" id="ram-val-${id}">0%</div>
            </div>`;
            startMonitor(id);
            w = 300; h = 400;
        } else if (appType === 'files') {
            title = 'File Explorer';
            content = `<div id="file-list-${id}" style="padding:10px;">Yükleniyor...</div>`;
            loadFiles(id);
        }

        const win = document.createElement('div');
        win.className = 'window';
        win.id = id;
        win.style.width = w + 'px';
        win.style.height = h + 'px';
        win.style.left = (100 + (zIndexCounter%10)*20) + 'px';
        win.style.top = (50 + (zIndexCounter%10)*20) + 'px';
        win.style.zIndex = ++zIndexCounter;
        
        win.innerHTML = `
            <div class="win-header" onmousedown="startDrag(event, '${id}')">
                <div class="win-title"><i class="fa fa-code me-2"></i> ${title}</div>
                <div class="win-controls">
                    <span class="win-min" onclick="minimizeWindow('${id}')"></span>
                    <span class="win-max" onclick="maximizeWindow('${id}')"></span>
                    <span class="win-close" onclick="closeWindow('${id}')"></span>
                </div>
            </div>
            <div class="win-body">${content}</div>
        `;

        document.getElementById('desktop').appendChild(win);
        addTaskbarItem(id, title);
    }

    function closeWindow(id) {
        document.getElementById(id).remove();
        document.getElementById('task-' + id).remove();
    }

    function addTaskbarItem(id, title) {
        const item = document.createElement('div');
        item.className = 'task-item active';
        item.id = 'task-' + id;
        item.innerText = title;
        item.onclick = () => {
            const win = document.getElementById(id);
            win.style.display = 'flex';
            win.style.zIndex = ++zIndexCounter;
        };
        document.getElementById('task-list').appendChild(item);
    }

    // --- APP LOGICS ---

    function handleTerminal(e, id, input) {
        if(e.key === 'Enter') {
            const cmd = input.value;
            const outputDiv = document.getElementById(`term-output-${id}`);
            outputDiv.innerHTML += `<div><span style="color:#00ff88">$</span> ${cmd}</div>`;
            
            let response = "Komut bulunamadı.";
            if(cmd === 'help') response = "Komutlar: help, clear, date, whoami, reboot";
            if(cmd === 'clear') { outputDiv.innerHTML = ""; response = ""; }
            if(cmd === 'date') response = new Date().toString();
            if(cmd === 'whoami') response = "root";
            if(cmd === 'reboot') location.reload();

            if(response) outputDiv.innerHTML += `<div style="color:#aaa; margin-bottom:10px;">${response}</div>`;
            input.value = "";
            
            // Auto scroll
            outputDiv.parentElement.scrollTop = outputDiv.parentElement.scrollHeight;
        }
    }

    async function sendChat(id) {
        const input = document.getElementById(`chat-in-${id}`);
        const hist = document.getElementById(`chat-hist-${id}`);
        const msg = input.value;
        if(!msg) return;

        hist.innerHTML += `<div class="msg user">${msg}</div>`;
        input.value = '';
        hist.scrollTop = hist.scrollHeight;

        // AJAX to PHP AI
        const res = await apiRequest('chat_ai', {message: msg});
        setTimeout(() => {
            hist.innerHTML += `<div class="msg ai">${res.reply}</div>`;
            hist.scrollTop = hist.scrollHeight;
        }, 500);
    }

    function startMonitor(id) {
        setInterval(async () => {
            if(!document.getElementById(id)) return;
            const res = await apiRequest('get_sysinfo');
            if(res.status==='success') {
                document.getElementById(`cpu-val-${id}`).innerText = res.cpu + '%';
                document.getElementById(`cpu-bar-${id}`).style.width = res.cpu + '%';
                document.getElementById(`ram-val-${id}`).innerText = res.ram + '%';
            }
        }, 2000);
    }

    async function loadFiles(id) {
        const res = await apiRequest('get_files');
        const container = document.getElementById(`file-list-${id}`);
        let html = '<ul style="list-style:none; padding:0;">';
        
        for (const [folder, files] of Object.entries(res.files)) {
            html += `<li><i class="fa fa-folder text-warning"></i> <b>${folder}</b><ul style="margin-left:20px; list-style:none;">`;
            for (const [file, content] of Object.entries(files)) {
                html += `<li onclick="alert('${content.replace(/\n/g, "\\n")}')" style="cursor:pointer; margin-top:5px;">
                            <i class="fa fa-file-code"></i> ${file}
                         </li>`;
            }
            html += '</ul></li>';
        }
        html += '</ul>';
        container.innerHTML = html;
    }

    // --- DRAGGABLE WINDOW LOGIC ---
    let isDragging = false;
    let dragOffsetX, dragOffsetY, currentWin;

    function startDrag(e, id) {
        isDragging = true;
        currentWin = document.getElementById(id);
        dragOffsetX = e.clientX - currentWin.offsetLeft;
        dragOffsetY = e.clientY - currentWin.offsetTop;
        currentWin.style.zIndex = ++zIndexCounter;
        
        document.addEventListener('mousemove', doDrag);
        document.addEventListener('mouseup', stopDrag);
    }

    function doDrag(e) {
        if (!isDragging) return;
        currentWin.style.left = (e.clientX - dragOffsetX) + 'px';
        currentWin.style.top = (e.clientY - dragOffsetY) + 'px';
    }

    function stopDrag() {
        isDragging = false;
        document.removeEventListener('mousemove', doDrag);
        document.removeEventListener('mouseup', stopDrag);
    }

</script>
</body>
</html>