<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AbdouTV - التثبيت</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --sky-500: #0EA5E9;
            --sky-600: #0284C7;
            --bg-body: #F0F4F8;
            --glass-blur: blur(14px);
            --glass-border: rgba(255, 255, 255, 0.6);
            --text-primary: #1E293B;
            --text-secondary: #475569;
            --text-muted: #94A3B8;
            --border: #E2E8F0;
            --radius: 14px;
            --shadow-card: 0 2px 16px rgba(14, 165, 233, 0.06), 0 1px 4px rgba(0,0,0,0.04);
            --shadow-lg: 0 12px 40px rgba(0, 0, 0, 0.12);
            --ease: cubic-bezier(0.4, 0, 0.2, 1);
            --success: #10B981;
            --danger: #EF4444;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-body);
            background-image:
                radial-gradient(ellipse at 10% 20%, rgba(186, 230, 253, 0.3) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 80%, rgba(186, 230, 253, 0.2) 0%, transparent 50%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .install-container {
            background: rgba(255, 255, 255, 0.72);
            backdrop-filter: var(--glass-blur);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius);
            padding: 40px;
            width: 100%;
            max-width: 600px;
            box-shadow: var(--shadow-lg);
            animation: cardIn 0.5s var(--ease);
        }

        @keyframes cardIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo i {
            font-size: 3rem;
            color: var(--sky-500);
        }

        .logo h1 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-top: 10px;
        }

        .steps-header {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 40px;
        }

        .step-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--text-muted);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            position: relative;
        }

        .step-circle.active {
            background: var(--sky-500);
        }

        .step-circle.done {
            background: var(--success);
        }

        .step-circle.done::after {
            content: '✓';
            font-size: 16px;
        }

        .step-content h3 {
            font-size: 1.5rem;
            color: var(--text-primary);
            margin-bottom: 20px;
            text-align: center;
        }

        .debug-info {
            text-align: center;
            margin-bottom: 20px;
        }

        .debug-link {
            display: inline-block;
            color: var(--sky-500);
            text-decoration: none;
            font-weight: 500;
            padding: 8px 16px;
            border: 1px solid var(--sky-500);
            border-radius: var(--radius);
            transition: all 0.3s var(--ease);
        }

        .debug-link:hover {
            background: var(--sky-500);
            color: white;
        }

        .requirements-list {
            margin-bottom: 30px;
        }

        .req-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 16px;
            margin-bottom: 8px;
            border-radius: var(--radius);
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid var(--border);
        }

        .req-item.passed {
            border-color: var(--success);
            background: rgba(16, 185, 129, 0.1);
        }

        .req-item.failed {
            border-color: var(--danger);
            background: rgba(239, 68, 68, 0.1);
        }

        .req-status {
            font-size: 18px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--text-primary);
            font-weight: 500;
        }

        .input-group input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            font-size: 16px;
            transition: border-color 0.3s var(--ease);
        }

        .input-group input:focus {
            outline: none;
            border-color: var(--sky-500);
        }

        .step-actions {
            display: flex;
            gap: 12px;
            justify-content: center;
            margin-top: 30px;
        }

        .btn-next, .btn-test {
            background: linear-gradient(135deg, var(--sky-500), var(--sky-600));
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: var(--radius);
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s var(--ease);
        }

        .btn-next:hover, .btn-test:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .btn-next:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .btn-login {
            background: linear-gradient(135deg, var(--sky-500), var(--sky-600));
            color: white;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: var(--radius);
            font-weight: 600;
            display: inline-block;
            transition: all 0.3s var(--ease);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .error-message {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: var(--danger);
            padding: 16px;
            border-radius: var(--radius);
            text-align: center;
            margin-top: 20px;
        }

        .test-result {
            padding: 12px 16px;
            border-radius: var(--radius);
            text-align: center;
            margin-top: 20px;
            font-weight: 500;
        }

        .test-result.success {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid var(--success);
            color: var(--success);
        }

        .test-result.error {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid var(--danger);
            color: var(--danger);
        }

        .install-progress {
            text-align: center;
            margin: 40px 0;
        }

        .progress-bar {
            width: 100%;
            height: 8px;
            background: var(--border);
            border-radius: 4px;
            overflow: hidden;
            margin-bottom: 16px;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--sky-500), var(--sky-600));
            width: 0%;
            transition: width 0.3s var(--ease);
        }

        .progress-text {
            color: var(--text-secondary);
            font-size: 14px;
        }

        .install-result {
            text-align: center;
            margin-top: 40px;
        }

        .success-icon {
            font-size: 4rem;
            color: var(--success);
            margin-bottom: 20px;
            animation: popIn 0.5s var(--ease);
        }

        @keyframes popIn {
            from {
                opacity: 0;
                transform: scale(0.5);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .install-result h4 {
            color: var(--text-primary);
            margin-bottom: 16px;
        }

        .install-result p {
            color: var(--text-secondary);
            margin-bottom: 30px;
        }

        .password-strength {
            margin-top: 8px;
        }

        .strength-bar {
            width: 100%;
            height: 4px;
            background: var(--border);
            border-radius: 2px;
            overflow: hidden;
            margin-bottom: 4px;
        }

        .strength-fill {
            height: 100%;
            width: 0%;
            transition: all 0.3s var(--ease);
        }

        #strengthText {
            font-size: 12px;
            color: var(--text-muted);
        }

        @media (max-width: 480px) {
            .install-container {
                margin: 20px;
                padding: 30px 20px;
            }

            .steps-header {
                gap: 10px;
            }

            .step-circle {
                width: 32px;
                height: 32px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="install-container">
        <div class="logo">
            <i class="fas fa-play-circle"></i>
            <h1>AbdouTV</h1>
        </div>

        <div class="steps-header">
            <div class="step-circle <?php echo $step >= 1 ? 'active' : ''; ?> <?php echo $step > 1 ? 'done' : ''; ?>">1</div>
            <div class="step-circle <?php echo $step >= 2 ? 'active' : ''; ?> <?php echo $step > 2 ? 'done' : ''; ?>">2</div>
            <div class="step-circle <?php echo $step >= 3 ? 'active' : ''; ?> <?php echo $step > 3 ? 'done' : ''; ?>">3</div>
            <div class="step-circle <?php echo $step >= 4 ? 'active' : ''; ?> <?php echo $step > 4 ? 'done' : ''; ?>">4</div>
        </div>

        <?php
        switch ($step) {
            case 1:
                include 'step1_requirements.php';
                break;
            case 2:
                include 'step2_database.php';
                break;
            case 3:
                include 'step3_admin.php';
                break;
            case 4:
                include 'step4_finish.php';
                break;
        }
        ?>
    </div>
</body>
</html>