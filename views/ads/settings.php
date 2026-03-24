<div class="glass-card">
    <div class="card-header">
        <h3><i class="fas fa-ads"></i> إعدادات الإعلانات</h3>
    </div>

    <form method="POST" action="?page=ads&action=save">
        <div class="ads-sections">
            <!-- AdMob Settings -->
            <div class="ads-section">
                <h4><i class="fab fa-google"></i> AdMob</h4>
                <div class="form-grid">
                    <div class="input-group">
                        <label for="admob_app_id">معرف التطبيق (App ID)</label>
                        <input type="text" id="admob_app_id" name="admob_app_id" value="<?php echo htmlspecialchars($adSettings['admob_app_id'] ?? ''); ?>" placeholder="ca-app-pub-XXXXXXXXXXXXXXXX~XXXXXXXXXX">
                    </div>

                    <div class="input-group">
                        <label for="admob_banner_id">معرف البانر (Banner ID)</label>
                        <input type="text" id="admob_banner_id" name="admob_banner_id" value="<?php echo htmlspecialchars($adSettings['admob_banner_id'] ?? ''); ?>" placeholder="ca-app-pub-XXXXXXXXXXXXXXXX/XXXXXXXXXX">
                    </div>

                    <div class="input-group">
                        <label for="admob_interstitial_id">معرف الإعلان المتداخل (Interstitial ID)</label>
                        <input type="text" id="admob_interstitial_id" name="admob_interstitial_id" value="<?php echo htmlspecialchars($adSettings['admob_interstitial_id'] ?? ''); ?>" placeholder="ca-app-pub-XXXXXXXXXXXXXXXX/XXXXXXXXXX">
                    </div>

                    <div class="input-group">
                        <label for="admob_rewarded_id">معرف الإعلان المكافأ (Rewarded ID)</label>
                        <input type="text" id="admob_rewarded_id" name="admob_rewarded_id" value="<?php echo htmlspecialchars($adSettings['admob_rewarded_id'] ?? ''); ?>" placeholder="ca-app-pub-XXXXXXXXXXXXXXXX/XXXXXXXXXX">
                    </div>
                </div>
            </div>

            <!-- AppLovin Settings -->
            <div class="ads-section">
                <h4><i class="fas fa-mobile-alt"></i> AppLovin</h4>
                <div class="form-grid">
                    <div class="input-group">
                        <label for="applovin_sdk_key">مفتاح SDK</label>
                        <input type="text" id="applovin_sdk_key" name="applovin_sdk_key" value="<?php echo htmlspecialchars($adSettings['applovin_sdk_key'] ?? ''); ?>" placeholder="XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX">
                    </div>

                    <div class="input-group">
                        <label for="applovin_banner_id">معرف البانر</label>
                        <input type="text" id="applovin_banner_id" name="applovin_banner_id" value="<?php echo htmlspecialchars($adSettings['applovin_banner_id'] ?? ''); ?>" placeholder="XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX">
                    </div>

                    <div class="input-group">
                        <label for="applovin_interstitial_id">معرف الإعلان المتداخل</label>
                        <input type="text" id="applovin_interstitial_id" name="applovin_interstitial_id" value="<?php echo htmlspecialchars($adSettings['applovin_interstitial_id'] ?? ''); ?>" placeholder="XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX">
                    </div>

                    <div class="input-group">
                        <label for="applovin_rewarded_id">معرف الإعلان المكافأ</label>
                        <input type="text" id="applovin_rewarded_id" name="applovin_rewarded_id" value="<?php echo htmlspecialchars($adSettings['applovin_rewarded_id'] ?? ''); ?>" placeholder="XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX">
                    </div>
                </div>
            </div>

            <!-- Unity Ads Settings -->
            <div class="ads-section">
                <h4><i class="fas fa-gamepad"></i> Unity Ads</h4>
                <div class="form-grid">
                    <div class="input-group">
                        <label for="unity_game_id">معرف اللعبة (Game ID)</label>
                        <input type="text" id="unity_game_id" name="unity_game_id" value="<?php echo htmlspecialchars($adSettings['unity_game_id'] ?? ''); ?>" placeholder="1234567">
                    </div>

                    <div class="input-group">
                        <label for="unity_banner_id">معرف البانر</label>
                        <input type="text" id="unity_banner_id" name="unity_banner_id" value="<?php echo htmlspecialchars($adSettings['unity_banner_id'] ?? ''); ?>" placeholder="banner">
                    </div>

                    <div class="input-group">
                        <label for="unity_interstitial_id">معرف الإعلان المتداخل</label>
                        <input type="text" id="unity_interstitial_id" name="unity_interstitial_id" value="<?php echo htmlspecialchars($adSettings['unity_interstitial_id'] ?? ''); ?>" placeholder="interstitial">
                    </div>

                    <div class="input-group">
                        <label for="unity_rewarded_id">معرف الإعلان المكافأ</label>
                        <input type="text" id="unity_rewarded_id" name="unity_rewarded_id" value="<?php echo htmlspecialchars($adSettings['unity_rewarded_id'] ?? ''); ?>" placeholder="rewardedVideo">
                    </div>
                </div>
            </div>

            <!-- IronSource Settings -->
            <div class="ads-section">
                <h4><i class="fas fa-rocket"></i> IronSource</h4>
                <div class="form-grid">
                    <div class="input-group">
                        <label for="ironsource_app_key">مفتاح التطبيق (App Key)</label>
                        <input type="text" id="ironsource_app_key" name="ironsource_app_key" value="<?php echo htmlspecialchars($adSettings['ironsource_app_key'] ?? ''); ?>" placeholder="XXXXXXXXXXXXXXXX">
                    </div>

                    <div class="input-group">
                        <label for="ironsource_banner_id">معرف البانر</label>
                        <input type="text" id="ironsource_banner_id" name="ironsource_banner_id" value="<?php echo htmlspecialchars($adSettings['ironsource_banner_id'] ?? ''); ?>" placeholder="XXXXXXXXXXXXXXXX">
                    </div>

                    <div class="input-group">
                        <label for="ironsource_interstitial_id">معرف الإعلان المتداخل</label>
                        <input type="text" id="ironsource_interstitial_id" name="ironsource_interstitial_id" value="<?php echo htmlspecialchars($adSettings['ironsource_interstitial_id'] ?? ''); ?>" placeholder="XXXXXXXXXXXXXXXX">
                    </div>

                    <div class="input-group">
                        <label for="ironsource_rewarded_id">معرف الإعلان المكافأ</label>
                        <input type="text" id="ironsource_rewarded_id" name="ironsource_rewarded_id" value="<?php echo htmlspecialchars($adSettings['ironsource_rewarded_id'] ?? ''); ?>" placeholder="XXXXXXXXXXXXXXXX">
                    </div>
                </div>
            </div>

            <!-- Ad Configuration -->
            <div class="ads-section">
                <h4><i class="fas fa-sliders-h"></i> إعدادات الإعلانات</h4>
                <div class="form-grid">
                    <div class="input-group">
                        <label for="ad_network_priority">أولوية شبكة الإعلانات</label>
                        <select id="ad_network_priority" name="ad_network_priority">
                            <option value="admob" <?php echo ($adSettings['ad_network_priority'] ?? 'admob') === 'admob' ? 'selected' : ''; ?>>AdMob</option>
                            <option value="applovin" <?php echo ($adSettings['ad_network_priority'] ?? '') === 'applovin' ? 'selected' : ''; ?>>AppLovin</option>
                            <option value="unity" <?php echo ($adSettings['ad_network_priority'] ?? '') === 'unity' ? 'selected' : ''; ?>>Unity Ads</option>
                            <option value="ironsource" <?php echo ($adSettings['ad_network_priority'] ?? '') === 'ironsource' ? 'selected' : ''; ?>>IronSource</option>
                        </select>
                    </div>

                    <div class="input-group">
                        <label for="banner_interval">فترة البانر (بالدقائق)</label>
                        <input type="number" id="banner_interval" name="banner_interval" value="<?php echo htmlspecialchars($adSettings['banner_interval'] ?? '5'); ?>" min="1" max="60">
                    </div>

                    <div class="input-group">
                        <label for="interstitial_interval">فترة الإعلان المتداخل (بالدقائق)</label>
                        <input type="number" id="interstitial_interval" name="interstitial_interval" value="<?php echo htmlspecialchars($adSettings['interstitial_interval'] ?? '10'); ?>" min="1" max="120">
                    </div>

                    <div class="input-group">
                        <label for="rewarded_interval">فترة الإعلان المكافأ (بالدقائق)</label>
                        <input type="number" id="rewarded_interval" name="rewarded_interval" value="<?php echo htmlspecialchars($adSettings['rewarded_interval'] ?? '15'); ?>" min="1" max="180">
                    </div>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">حفظ إعدادات الإعلانات</button>
        </div>
    </form>
</div>

<style>
.ads-sections {
    display: flex;
    flex-direction: column;
    gap: 30px;
}

.ads-section {
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 20px;
}

.ads-section h4 {
    margin-bottom: 20px;
    color: var(--text-primary);
    font-size: 18px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.ads-section h4 i {
    color: var(--sky-500);
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}

.input-group {
    display: flex;
    flex-direction: column;
}

.input-group label {
    margin-bottom: 8px;
    font-weight: 500;
    color: var(--text-primary);
}

.input-group input,
.input-group select {
    padding: 12px;
    border: 1px solid var(--border);
    border-radius: var(--radius);
    background: var(--bg-card);
    color: var(--text-primary);
    font-size: 14px;
}

.input-group input:focus,
.input-group select:focus {
    outline: none;
    border-color: var(--sky-500);
    box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
}

.input-group input::placeholder {
    color: var(--text-muted);
}
.form-actions {
    margin-top: 30px;
    display: flex;
    justify-content: flex-end;
}
.btn-primary {
    background-color: var(--primary-color);
    color: #fff;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 4px;
    font-size: 16px;
}
.btn-primary:hover {
    background-color: var(--primary-color-hover);
}
</style>