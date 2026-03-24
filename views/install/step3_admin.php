<div class="step-content">
    <h3>إنشاء حساب المشرف</h3>
    <p>أدخل بيانات حساب المشرف الأول.</p>

    <form method="POST">
        <div class="input-group">
            <label for="email">البريد الإلكتروني</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="input-group">
            <label for="password">كلمة المرور</label>
            <input type="password" id="password" name="password" required minlength="8">
            <div class="password-strength">
                <div id="strengthBar" class="strength-bar">
                    <div id="strengthFill" class="strength-fill"></div>
                </div>
                <span id="strengthText">قوة كلمة المرور</span>
            </div>
        </div>

        <div class="input-group">
            <label for="confirm_password">تأكيد كلمة المرور</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>

        <div class="step-actions">
            <button type="submit" class="btn-next">التالي: الإنهاء</button>
        </div>
    </form>
</div>

<script>
document.getElementById('password').addEventListener('input', function() {
    const password = this.value;
    const strength = calculatePasswordStrength(password);
    updateStrengthIndicator(strength);
});

function calculatePasswordStrength(password) {
    let score = 0;
    if (password.length >= 8) score++;
    if (/[a-z]/.test(password)) score++;
    if (/[A-Z]/.test(password)) score++;
    if (/[0-9]/.test(password)) score++;
    if (/[^A-Za-z0-9]/.test(password)) score++;
    return score;
}

function updateStrengthIndicator(strength) {
    const fill = document.getElementById('strengthFill');
    const text = document.getElementById('strengthText');

    const colors = ['#DC2626', '#F59E0B', '#F59E0B', '#10B981', '#10B981'];
    const texts = ['ضعيف جداً', 'ضعيف', 'متوسط', 'قوي', 'قوي جداً'];

    fill.style.width = (strength * 20) + '%';
    fill.style.backgroundColor = colors[strength - 1] || '#DC2626';
    text.textContent = texts[strength - 1] || 'ضعيف جداً';
}

// Password confirmation validation
document.getElementById('confirm_password').addEventListener('input', function() {
    const password = document.getElementById('password').value;
    const confirm = this.value;

    if (password !== confirm) {
        this.setCustomValidity('كلمة المرور غير متطابقة');
    } else {
        this.setCustomValidity('');
    }
});
</script>