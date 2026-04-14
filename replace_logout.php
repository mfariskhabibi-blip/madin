<?php
$directory = new RecursiveDirectoryIterator('c:/Users/Faris/madin/app/Views');
$iterator = new RecursiveIteratorIterator($directory);
$files = [];

foreach ($iterator as $info) {
    if ($info->isFile() && $info->getExtension() === 'php') {
        $files[] = $info->getPathname();
    }
}

$oldPattern = '/\/\/\s*Logout (?:confirmation|functionality)[\s\S]*?const logoutBtn = document\.getElementById\(\'logoutBtn\'\);[\s\S]*?if\s*\(logoutBtn\)\s*\{[\s\S]*?logoutBtn\.addEventListener\(\'click\',\s*function\s*\(\s*e\s*\)\s*\{[\s\S]*?e\.preventDefault\(\);[\s\S]*?if\s*\(confirm\([^\)]+\)\)\s*\{[\s\S]*?window\.location\.href\s*=\s*(?:this\.getAttribute\(\'href\'\)|this\.href);[\s\S]*?\}[\s\S]*?\}\);[\s\S]*?\}/i';

$newBlock = <<<'EOD'
// Logout confirmation modal
        const logoutBtn = document.getElementById('logoutBtn');
        if (logoutBtn) {
            logoutBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const logoutUrl = this.getAttribute('href');
                
                const modalHtml = `
                <div id="logoutModal" style="position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:9999;display:flex;align-items:center;justify-content:center;opacity:0;transition:opacity 0.3s;backdrop-filter:blur(3px);">
                    <div style="background:white;padding:30px;border-radius:12px;box-shadow:0 10px 25px rgba(0,0,0,0.2);text-align:center;max-width:350px;width:90%;transform:translateY(-20px);transition:transform 0.3s;">
                        <div style="width:60px;height:60px;background:rgba(229,62,62,0.1);color:#e53e3e;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:2rem;margin:0 auto 15px;">
                            <i class="fas fa-sign-out-alt"></i>
                        </div>
                        <h3 style="margin-bottom:10px;color:#2d3748;font-size:1.2rem;font-weight:700;">Konfirmasi Keluar</h3>
                        <p style="color:#718096;margin-bottom:25px;font-size:0.95rem;">Apakah Anda yakin ingin keluar dari sistem PTQ Pencongan?</p>
                        <div style="display:flex;gap:10px;justify-content:center;">
                            <button id="cancelLogout" style="padding:10px 20px;border-radius:8px;border:1px solid #e2e8f0;background:white;color:#4a5568;font-weight:600;cursor:pointer;flex:1;transition:all 0.2s;">Batal</button>
                            <a href="${logoutUrl}" style="padding:10px 20px;border-radius:8px;border:none;background:#e53e3e;color:white;font-weight:600;cursor:pointer;text-decoration:none;flex:1;transition:all 0.2s;display:flex;align-items:center;justify-content:center;">Ya, Keluar</a>
                        </div>
                    </div>
                </div>`;
                
                document.body.insertAdjacentHTML('beforeend', modalHtml);
                const modal = document.getElementById('logoutModal');
                const cancelBtn = document.getElementById('cancelLogout');
                
                setTimeout(() => {
                    modal.style.opacity = '1';
                    modal.children[0].style.transform = 'translateY(0)';
                }, 10);
                
                let cancelHover = function() { this.style.background = '#f7fafc'; };
                let cancelOut = function() { this.style.background = 'white'; };
                cancelBtn.addEventListener('mouseover', cancelHover);
                cancelBtn.addEventListener('mouseout', cancelOut);
                
                const closeModal = () => {
                    modal.style.opacity = '0';
                    modal.children[0].style.transform = 'translateY(-20px)';
                    setTimeout(() => modal.remove(), 300);
                };
                
                cancelBtn.addEventListener('click', closeModal);
                modal.addEventListener('click', (ev) => {
                    if(ev.target === modal) closeModal();
                });
            });
        }
EOD;

$modifiedCount = 0;
foreach ($files as $file) {
    if (strpos($file, 'auth/') !== false) continue; // Skip auth views
    
    $content = file_get_contents($file);
    $newContent = preg_replace($oldPattern, $newBlock, $content);
    
    if ($newContent !== null && $newContent !== $content) {
        file_put_contents($file, $newContent);
        echo "Modified: " . $file . "\n";
        $modifiedCount++;
    }
}
echo "Total modified files: " . $modifiedCount . "\n";
