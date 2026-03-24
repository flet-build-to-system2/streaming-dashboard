<div class="step-content">
    <h3>إعداد قاعدة البيانات</h3>
    <p>أدخل بيانات الاتصال بقاعدة البيانات MySQL.</p>

    <form id="dbForm" method="POST">
        <div class="input-group">
            <label for="host">اسم المضيف</label>
            <input type="text" id="host" name="host" value="sql210.infinityfree.com" required>
        </div>

        <div class="input-group">
            <label for="db_name">اسم قاعدة البيانات</label>
            <input type="text" id="db_name" name="db_name" value="if0_41338478_dashboard" required>
        </div>

        <div class="input-group">
            <label for="username">اسم المستخدم</label>
            <input type="text" id="username" name="username" value="if0_41338478" required>
        </div>

        <div class="input-group">
            <label for="password">كلمة المرور</label>
            <input type="password" id="password" name="password">
        </div>

        <div class="step-actions">
            <button type="button" id="testBtn" class="btn-test">اختبار الاتصال</button>
            <button type="submit" id="nextBtn" class="btn-next" disabled>التالي: إنشاء الحساب</button>
        </div>
    </form>

    <div id="testResult" class="test-result" style="display: none;"></div>
</div>

<script>
document.getElementById('testBtn').addEventListener('click', function() {
    const formData = new FormData(document.getElementById('dbForm'));
    formData.append('ajax', 'test');

    fetch('install.php?step=2', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        const resultDiv = document.getElementById('testResult');
        resultDiv.style.display = 'block';
        if (data.success) {
            resultDiv.className = 'test-result success';
            resultDiv.textContent = '✅ ' + data.message;
            document.getElementById('nextBtn').disabled = false;
        } else {
            resultDiv.className = 'test-result error';
            resultDiv.textContent = '❌ ' + data.message;
            document.getElementById('nextBtn').disabled = true;
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
</script>