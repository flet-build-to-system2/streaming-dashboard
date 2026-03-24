const AdsManager = {
    networks: {
        admob: ['App ID', 'Banner ID', 'Interstitial ID', 'Rewarded ID'],
        applovin: ['SDK Key', 'Banner Zone ID', 'Interstitial Zone ID'],
        unity: ['Game ID', 'Banner Placement', 'Interstitial Placement'],
        startapp: ['App ID']
    },

    renderFields(network) {
        const container = document.getElementById('dynamicFields');
        container.innerHTML = `<h4>إعدادات ${network.toUpperCase()}</h4>`;
        
        this.networks[network].forEach(field => {
            const fieldId = field.toLowerCase().replace(/ /g, '_');
            container.innerHTML += `
                <div class="input-group">
                    <label>${field}</label>
                    <input type="text" name="settings[${fieldId}]" class="form-control" required>
                </div>
            `;
        });
    }
};

// الاستماع لتغيير الشبكة
document.querySelectorAll('input[name="network_name"]').forEach(radio => {
    radio.addEventListener('change', (e) => AdsManager.renderFields(e.target.value));
});

// التشغيل الافتراضي عند التحميل
AdsManager.renderFields('admob');