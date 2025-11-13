![PrestaShop](https://badgen.net/badge/PrestaShop/8.x/blue)
![PHP](https://badgen.net/badge/PHP/8.0%20%7C%208.1/8892BF)
![Latest Release](https://badgen.net/github/release/josemanuelpedraja/cf-football-bypass-prestashop?include_prereleases)
![License](https://badgen.net/github/license/JoseManuelPedraja/cf-football-bypass-prestashop)
![Downloads](https://img.shields.io/github/downloads/JoseManuelPedraja/cf-football-bypass-prestashop/total)
![Stars](https://badgen.net/github/stars/JoseManuelPedraja/cf-football-bypass-prestashop)
![Forks](https://badgen.net/github/forks/JoseManuelPedraja/cf-football-bypass-prestashop)

# ⚽ CF Football Bypass for PrestaShop

A PrestaShop module that automates switching between **Proxied** and **DNS Only** modes in Cloudflare during massive blocking events on football match days.

The module fetches the feed from [hayahora.futbol](https://hayahora.futbol/) and enables/disables the selected DNS records to keep your legitimate store accessible, with a configurable cooldown period before reactivating Cloudflare.

---

## 🚀 Quick Installation

1. Download the ZIP file from [GitHub](https://github.com/JoseManuelPedraja/cf-football-bypass-prestashop/releases).  
2. Copy the `cffootballbypass` folder into your PrestaShop modules directory.  
3. From the **Back Office**, go to **Modules > Module Manager** and activate **CF Football Bypass**.  
4. Configure the module under **Advanced Parameters > CF Football Bypass**, where you can set:  
   - The checking interval  
   - The cooldown period after disabling Cloudflare  
   - The DNS records you want to manage  

---

## ⚙️ Requirements

- PrestaShop 8 or higher  
- Active Cloudflare account  
- Cloudflare API access with permissions to manage DNS  

---

## 👨‍💻 Original Author & WordPress Support

- **Original Author:** David Carrero ([@carrero](https://x.com/carrero))  
- **Website:** [carrero.es](https://carrero.es)  
- **Quick Contact:** [carrero.es/contacto](https://carrero.es/contacto/)  

> ⚠️ Note: This module has been adapted from the original WordPress version to PrestaShop with the author's permission and is completely free.

---

## 📖 Documentation

If you want to use an **external cron**, follow these steps:

1. Add the following code to your `.htaccess` file located in `var/www/public_html/modules/`:

```apache
<Files "cron.php">
    <If "%{REQUEST_URI} =~ m#^/modules/cffootballbypass/cron\.php#">
        Require all granted
    </If>
</Files>
