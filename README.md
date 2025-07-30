# 🧬 Deteksi Penyakit Kulit – Metode Certainity Factor (CI 4)

Aplikasi web berbasis CodeIgniter 4 untuk mendeteksi penyakit kulit menggunakan metode **Certainty Factor**. Sistem ini bertujuan membantu pengguna mengenali kemungkinan penyakit berdasarkan gejala yang dialami.

## 🩺 Fitur Utama
- Input gejala penyakit kulit
- Diagnosa otomatis berbasis Certainty Factor
- Hasil diagnosa dengan nilai keyakinan
- Manajemen data penyakit & gejala (admin)
- Antarmuka sederhana & responsif

## ⚙️ Tech Stack
- **Backend:** PHP 8+, CodeIgniter 4
- **Database:** MySQL / MariaDB
- **Frontend:** Bootstrap / jQuery (opsional)

## 📦 Instalasi

1. **Clone repository**
   ```bash
   git clone https://github.com/RizalRio/skin-disease-es-certainlyfactor-ci4.git
   cd skin-disease-es-certainlyfactor-ci4
Install dependensi

bash
Salin
Edit
composer install
Copy .env dan konfigurasi

bash
Salin
Edit
cp env .env
php spark key:generate
# Edit koneksi DB sesuai kebutuhan
Migrasi database

bash
Salin
Edit
php spark migrate
Jalankan server lokal

bash
Salin
Edit
php spark serve
📊 Metode Certainty Factor (CF)
Metode Certainty Factor digunakan untuk menghitung tingkat kepastian berdasarkan pengetahuan pakar. Rumus dasarnya:

mathematica
Salin
Edit
CF(H,E) = MB(H,E) - MD(H,E)
MB = Measure of Belief

MD = Measure of Disbelief

Semakin tinggi nilai CF, semakin yakin sistem terhadap diagnosa penyakit tersebut.

📸 Preview / Screenshot
(Tambahkan tangkapan layar halaman diagnosa atau form input gejala di sini)

🎯 Tujuan Proyek
Sebagai media pembelajaran dan eksperimen implementasi metode AI pakar di dunia nyata menggunakan framework PHP modern.

Made with ❤️ by RizalRio
🔍 Feel free to fork, study, and contribute!
