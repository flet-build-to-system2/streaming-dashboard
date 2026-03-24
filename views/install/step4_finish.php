<div class="step-content">
    <h3>الإنهاء والتثبيت</h3>
    <p>جاري تثبيت AbdouTV...</p>

    <div id="installProgress" class="install-progress">
        <div class="progress-bar">
            <div id="progressFill" class="progress-fill"></div>
        </div>
        <div id="progressText" class="progress-text">جاري التحضير...</div>
    </div>

    <div id="installResult" class="install-result" style="display: none;">
        <div class="success-icon">✅</div>
        <h4>تم التثبيت بنجاح!</h4>
        <p>AbdouTV جاهز للاستخدام. يمكنك الآن تسجيل الدخول باستخدام حساب المشرف.</p>
        <a href="../public/index.php" class="btn-login">الدخول إلى النظام</a>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const progressFill = document.getElementById('progressFill');
    const progressText = document.getElementById('progressText');
    const installResult = document.getElementById('installResult');

    const steps = [
        'إنشاء قاعدة البيانات...',
        'إنشاء الجداول...',
        'إدراج البيانات الأولية...',
        'إنشاء حساب المشرف...',
        'كتابة ملف التكوين...',
        'إنهاء التثبيت...'
    ];

    let currentStep = 0;

    function updateProgress(step) {
        const percentage = ((step + 1) / steps.length) * 100;
        progressFill.style.width = percentage + '%';
        progressText.textContent = steps[step];
    }

    function performInstall() {
        const formData = new FormData();
        formData.append('ajax', 'install');

        fetch('install.php?step=4', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateProgress(steps.length - 1);
                setTimeout(() => {
                    document.getElementById('installProgress').style.display = 'none';
                    installResult.style.display = 'block';
                }, 1000);
            } else {
                progressText.textContent = 'خطأ في التثبيت: ' + data.message;
                progressFill.style.backgroundColor = '#DC2626';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            progressText.textContent = 'خطأ في التثبيت';
            progressFill.style.backgroundColor = '#DC2626';
        });
    }

    // Simulate progress steps
    const interval = setInterval(() => {
        if (currentStep < steps.length - 1) {
            updateProgress(currentStep);
            currentStep++;
        } else {
            clearInterval(interval);
            performInstall();
        }
    }, 800);
});
</script>