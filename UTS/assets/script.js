// assets/script.js

// Menunggu seluruh elemen DOM (HTML) selesai dimuat
document.addEventListener('DOMContentLoaded', function(){
  const form = document.getElementById('bmiForm');
  const btnHitung = document.getElementById('btnHitung');
  const hasilCard = document.getElementById('hasilCard');
  const outNama = document.getElementById('outNama');
  const outEmail = document.getElementById('outEmail');
  const outBMI = document.getElementById('outBMI');
  const outKategori = document.getElementById('outKategori');
  const riwayatList = document.getElementById('riwayatList');
  const scrollBtn = document.getElementById('scrollToForm');
  const hitungUlangBtn = document.getElementById('hitungUlang');

  //Scroll ke form (misal saat user klik tombol di hero)
  if (scrollBtn) {
    scrollBtn.addEventListener('click', () => {
      document.getElementById('formSection').scrollIntoView({behavior: 'smooth', block:'start'});
    });
  }

  // simple validation helpers (Tampilkan pesan error pada input tertentu)
  function setError(fieldName, msg) {
    const el = document.querySelector('.error[data-for="' + fieldName + '"]');
    if (el) el.textContent = msg;
    const input = document.getElementById(fieldName);
    if (input) input.classList.add('invalid');
  }

  // Hapus semua pesan error & kelas invalid sebelum validasi ulang
  function clearErrors() {
    document.querySelectorAll('.error').forEach(e=> e.textContent = '');
    document.querySelectorAll('input').forEach(i => i.classList.remove('invalid'));
  }

  // Menentukan kategori BMI berdasar angka BMI
  function kategoriFromBMI(bmi) {
    if (bmi < 18.5) return 'Underweight';
    if (bmi < 25) return 'Normal';
    if (bmi < 30) return 'Overweight';
    return 'Obese';
  }

  // Validasi form di sisi client sebelum dikirim ke server
  function validateForm(data) {
    clearErrors(); // bersihkan error sebelumnya
    let ok = true; // status validasi awal
    // Validasi nama, email, berat, tinggi  
    if (!data.get('nama') || data.get('nama').trim() === '') {
      setError('nama', 'Nama wajib diisi');
      ok = false;
    }
    const email = data.get('email')||'';
    if (!email.trim()) {
      setError('email', 'Email wajib diisi');
      ok = false;
    } else {
      const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // regex untuk format email
      if (!re.test(email.trim())) {
        setError('email', 'Format email tidak valid');
        ok = false;
      }
    }
    const berat = parseFloat(data.get('berat') || 0);
    const tinggi = parseFloat(data.get('tinggi') || 0);
    if (!(berat > 0)) { setError('berat', 'Masukkan berat badan yang valid'); ok = false; }
    if (!(tinggi > 0)) { setError('tinggi', 'Masukkan tinggi badan yang valid'); ok = false; }
    return ok;
  }

  // Tambahkan hasil terbaru ke daftar riwayat di tampilan (tanpa reload)
  function appendHistory(record, toTop = true) {
    // Buat elemen list item baru untuk satu hasil riwayat
    const li = document.createElement('li');
    li.className = 'history-item';
    li.innerHTML = `
      <div style="display:flex;align-items:center;gap:12px">
        <div class="avatar">👤</div>
        <div class="info">
          <div class="name">${escapeHtml(record.nama)}</div>
          <div class="email muted">${escapeHtml(record.email)}</div>
        </div>
      </div>
      <div class="meta">
        <div class="bmi">${escapeHtml(record.bmi)}</div>
        <div class="kategori muted">${escapeHtml(record.kategori)}</div>
      </div>`;

    // Pastikan ada <ul> untuk riwayat, jika belum ada maka buat baru
    const ul = riwayatList.querySelector('.history') || (function(){
      const ul = document.createElement('ul'); 
      ul.className = 'history'; 
      riwayatList.innerHTML=''; // hapus isi sebelumnya
      riwayatList.appendChild(ul); 
      return ul;
    })();

    // Tambahkan item baru di atas (default) atau di bawah
    if (toTop) ul.insertBefore(li, ul.firstChild);
    else ul.appendChild(li);
  }

  // Escape HTML untuk mencegah XSS (karakter berbahaya diubah)
  function escapeHtml(str) {
    if (!str && str !== 0) return '';
    return String(str).replace(/[&<>"']/g, function(m){
      return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m];
    });
  }

  // form submit via AJAX
  form.addEventListener('submit', function(e){
    e.preventDefault(); // cegah reload halaman
    const data = new FormData(form); // ambil semua input dari form

    // Validasi dulu di sisi client
    if (!validateForm(data)) {
      //Efek animasi goyang jika gagal validasi
      form.classList.add('shake');
      setTimeout(()=> form.classList.remove('shake'), 350);
      return;
    }

    // Nonaktifkan tombol sementara untuk mencegah klik ganda
    btnHitung.disabled = true;
    btnHitung.textContent = 'Menghitung...';

    // Tambahkan parameter "ajax" agar server tahu ini permintaan AJAX
    data.append('ajax', '1');

    // Kirim data ke server (hitung.php) lewat AJAX
    fetch('hitung.php', {
      method: 'POST',
      body: data
    }).then(r => r.json()) // ubah respons jadi JSON
      .then(res => {
        // Re-enable tombol
        btnHitung.disabled = false;
        btnHitung.textContent = 'Hitung BMI';
        if (res.success) {
          // Jika server berhasil mengembalikan hasil
          const d = res.data;
          // Tampilkan hasil pada kartu
          outNama.textContent = d.nama;
          outEmail.textContent = d.email;
          outBMI.textContent = d.bmi;
          outKategori.textContent = d.kategori;
          hasilCard.classList.remove('hidden'); // tampilkan hasil
          // Tambahkan ke daftar riwayat di UI (tanpa reload)
          appendHistory(d, true);
          // Scroll ke bagian hasil dengan animasi halus
          document.getElementById('hasilSection').scrollIntoView({behavior:'smooth'});
        } else {
          // Jika ada error dari server
          if (res.errors) {
            // Tampilkan error spesifik dari server di input terkait
            Object.keys(res.errors).forEach(k => setError(k, res.errors[k]));
          } else {
            alert(res.message || 'Terjadi kesalahan server');
          }
        }
      })
      .catch(err => {
        // Jika fetch gagal (misal koneksi putus)
        btnHitung.disabled = false;
        btnHitung.textContent = 'Hitung BMI';
        alert('Gagal menghubungi server. Coba lagi.');
        console.error(err);
      });
  });

  // Tombol "Hitung Ulang" diklik
  if (hitungUlangBtn) {
    hitungUlangBtn.addEventListener('click', function(){
      hasilCard.classList.add('hidden');
      window.scrollTo({
        // Scroll kembali ke bagian form
        top: document.getElementById('formSection').offsetTop - 30, 
        behavior:'smooth'});
    });
  }
});
