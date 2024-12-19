## **Knowly - Knowledge Network for Online Web-based Learning and Yield** 

Knowly adalah Learning Management System (LMS) yang dirancang untuk mendukung proses pembelajaran online dengan lebih efektif dan hasil yang terukur. Sebagai solusi terintegrasi, Knowly memungkinkan institusi pendidikan, organisasi, dan individu untuk mengelola, mengakses, dan mengoptimalkan pengalaman pembelajaran berbasis web.

<hr />  

**Jenis Akun Pengguna:**  
Knowly mendukung tiga jenis akun pengguna, yaitu:  
1. **Administrator (Super Admin & Admin)**  
2. **Guru**  
3. **Siswa**  

---
### **Clone Repository**  
1. Clone repository dengan cara copy link repository dan jalankan di cmd  
   ```bash  
   git clone https://github.com/calvinrdtya/Knowly.git
   ```  
2. Setelah Knowly berhasil di clone jalankan Instalasi

### **Instalasi**  
1. Install dependensi:  
   ```bash  
   composer install  
   ```  
2. Copy .env.example ke .env dengan menjalankan perintah dibawah
    ```bash
    cp .env.example .env
    ```
3. Atur kredensial database dan pengaturan aplikasi di file .env
    ```bash
    php artisan key:generate
    ```
4. Migrasi database
   ```bash  
   php artisan migrate
   ```  
5. Isi data awal database (seeding)
   ```bash  
   php artisan db:seed  
   ```  
6. Jalankan 
   ```bash  
   php artisan serve 
   ```  

---

### **Kredensial Login**  
Setelah seeding database, gunakan detail login berikut:  

| Jenis Akun    | Username  | Email                | Password |
|---------------|-----------|----------------------|----------|
| Super Admin   | Knowly        | superadmin@gmail.com            | knowly       |
| Guru         | Guru     | guru@gmail.com      | knowly       |
| Siswa          | Siswa   | siswa@gmail.com  | knowly       |

---


### **Fungsi Akun**  

**Super Admin**  
- Hanya Super Admin yang dapat menghapus data apa pun.  
- Membuat semua jenis akun pengguna.  
- Membuat Jadwal

**Guru**  
- Mengelola kelas sendiri.  
- Mengelola catatan ujian untuk mata pelajaran yang diajarkan.  
- Mengelola profil sendiri.  
- Mengunggah tugas pembelajaran. 
- Membuat Kuis

**Siswa**  
- Melihat profil guru.  
- Melihat mata pelajaran kelas sendiri.  
- Melihat papan pengumuman dan acara sekolah di kalender.  
- Mengelola profil sendiri.  
- Mengakses Kuis

---

## screenshot ##

**Home**
<img src="./public/all/ss/1.png">

**Team**
<img src="./public/all/ss/2.png">

**Login**
<img src="./public/all/ss/3.png">

--- 
## ROLE SISWA ##

**Dashboard**
<img src="./public/all/ss/siswa/5.png">

**Kalender Akademik**
<img src="./public/all/ss/siswa/6.png">

**Mata Pelajaran**
<img src="./public/all/ss/siswa/7.png">

**Halaman Absen**
<img src="./public/all/ss/siswa/8.png">

**Jadwal harian**
<img src="./public/all/ss/siswa/9.png">

**Tugas**
<img src="./public/all/ss/siswa/10.png">

**Pengumpulan Tugas**
<img src="./public/all/ss/siswa/11.png">

**Kuis**
<img src="./public/all/ss/siswa/12.png">

--- 
## ROLE GURU ##

**DASHBOARD**
<img src="./public/all/ss/guru/1.png">

**KALENDER AKADEMIK**
<img src="./public/all/ss/guru/2.png">

**ABSENSI MATA PELAJARAN**
<img src="./public/all/ss/guru/3.png">

**TUGAS**
<img src="./public/all/ss/guru/4.png">

**BUAT TUGAS**
<img src="./public/all/ss/guru/5.png">

**DETAIL TUGAS**
<img src="./public/all/ss/guru/8.png">

**KUIS**
<img src="./public/all/ss/guru/6.png">

**BUAT KUIS**
<img src="./public/all/ss//guru/7.png">
