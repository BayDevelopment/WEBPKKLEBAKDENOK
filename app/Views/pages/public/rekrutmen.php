  <?php

    use CodeIgniter\I18n\Time;

    /** now dalam WIB agar konsisten untuk humanize */
    $nowWIB = Time::now('Asia/Jakarta');
    ?>

  <?= $this->extend('templates/template_public') ?>
  <?= $this->section('content_public') ?>

  <style>
      .page-title {
          font-weight: 800;
          letter-spacing: .2px;
          background: linear-gradient(45deg, #4e73df, #1cc88a);
          -webkit-background-clip: text;
          -webkit-text-fill-color: transparent
      }

      .card-modern {
          border: 0;
          border-radius: 18px;
          box-shadow: 0 10px 24px rgba(15, 23, 42, .08);
          overflow: hidden;
          position: relative
      }

      .card-modern::before {
          content: "";
          position: absolute;
          left: 0;
          top: 0;
          right: 0;
          height: 3px;
          background: linear-gradient(90deg, rgba(78, 115, 223, .6), rgba(28, 200, 138, .6));
          opacity: .5
      }

      .badge-soft {
          background: rgba(78, 115, 223, .08);
          color: #4e73df;
          border: 1px solid rgba(78, 115, 223, .2);
          border-radius: 999px
      }

      .btn-gradient {
          background: linear-gradient(135deg, #4e73df, #1cc88a);
          color: #fff !important;
          border: 0;
          box-shadow: 0 8px 18px rgba(78, 115, 223, .25);
          transition: transform .18s, box-shadow .18s, filter .18s
      }

      .btn-gradient:hover {
          transform: translateY(-1px);
          box-shadow: 0 12px 24px rgba(78, 115, 223, .35);
          filter: saturate(1.05)
      }

      .form-soft {
          background: #f8fafc;
          border: 1px solid #e5e7eb
      }

      .form-soft:focus {
          border-color: #c7d2fe;
          box-shadow: 0 0 0 .15rem rgba(78, 115, 223, .15)
      }

      .help-text {
          color: #6b7280;
          font-size: .85rem
      }

      .required:after {
          content: " *";
          color: #e11d48;
          font-weight: 700
      }

      .select-pokja-col .form-select.form-soft {
          width: 100%;
          border: 1px solid #e5e7eb;
          border-radius: 10px;
          padding: .6rem .9rem;
          transition: border-color .2s, box-shadow .2s;
          background: #fff
      }

      .select-pokja-col .form-select.form-soft:hover {
          border-color: #d1d5db
      }

      .select-pokja-col .form-select.form-soft:focus {
          border-color: #6366f1;
          box-shadow: 0 0 0 .2rem rgba(99, 102, 241, .15);
          outline: 0
      }

      .select-pokja-col .form-select.form-soft.is-invalid {
          border-color: #ef4444 !important;
          box-shadow: 0 0 0 .2rem rgba(239, 68, 68, .15)
      }

      #pas_foto.form-control[type=file] {
          padding: 10px 12px;
          border: 1.5px dashed #e5e7eb;
          border-radius: 14px;
          background: #fbfbff;
          box-shadow: 0 6px 20px rgba(2, 6, 23, .04);
          transition: border-color .2s, background .2s, box-shadow .2s, transform .1s
      }

      #pas_foto.form-control[type=file]:hover {
          border-color: #c7d2fe;
          background: #f5f7ff;
          transform: translateY(-1px)
      }

      #pas_foto.form-control[type=file]::file-selector-button {
          margin-right: 12px;
          padding: 8px 12px;
          border: 0;
          border-radius: 10px;
          font-weight: 600;
          color: #fff;
          background: linear-gradient(135deg, #4e73df, #1cc88a);
          box-shadow: 0 6px 18px rgba(78, 115, 223, .25);
          cursor: pointer
      }

      #prev_pas_foto {
          display: block;
          inline-size: clamp(180px, 34vw, 260px);
          aspect-ratio: 3/4;
          object-fit: cover;
          object-position: center;
          border-radius: 16px;
          border: 1px solid #e5e7eb;
          background: #f3f4f6
      }

      /* Hero gradient glass */
      .about-hero {
          background:
              radial-gradient(1200px 300px at -10% -10%, rgba(13, 110, 253, 0.25), transparent 60%),
              radial-gradient(900px 300px at 110% -10%, rgba(32, 201, 151, 0.25), transparent 60%),
              linear-gradient(135deg, #0d1b2a, #163f6b 55%, #1b5eaa);
          box-shadow: 0 12px 40px rgba(13, 27, 42, 0.25);
          position: relative;
          overflow: hidden;
      }

      .about-hero::after {
          content: "";
          position: absolute;
          inset: 0;
          backdrop-filter: saturate(120%) blur(0px);
          pointer-events: none;
      }

      /* Fade-in on scroll */
      .reveal {
          opacity: 0;
          transform: translateY(14px);
          transition: opacity .6s ease, transform .6s ease;
          transition-delay: var(--d, 0ms);
          will-change: opacity, transform;
      }

      .reveal.is-visible {
          opacity: 1;
          transform: none;
      }

      @media (prefers-reduced-motion: reduce) {
          .reveal {
              opacity: 1 !important;
              transform: none !important;
              transition: none !important;
          }
      }
  </style>

  <div class="container py-4 reveal" style="--d:120ms">
      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="mb-4">
          <ol class="breadcrumb breadcrumb-modern px-3 py-2 rounded-3">
              <li class="breadcrumb-item">
                  <a href="/" class="text-decoration-none"><i class="fa-solid fa-house me-1"></i>Beranda</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">Pelaksanaan Program</li>
          </ol>
      </nav>

      <header class="about-hero rounded-4 p-4 p-lg-5 mb-4 text-white">
          <div class="row align-items-center g-4">
              <div class="col-lg-8">
                  <h1 class="display-6 fw-bold mb-2">Form Rekrutmen</h1>
                  <p class="lead mb-0 opacity-90">
                      TP PKK Kelurahan Lebak Denok — Bersama mewujudkan keluarga sehat, cerdas, dan sejahtera.
                  </p>
              </div>
          </div>
      </header>

      <div class="row mb-3">
          <div class="col-xl-8 col-lg-9">
              <div class="card card-modern">
                  <div class="card-header d-flex justify-content-between align-items-center">
                      <div class="d-flex align-items-center gap-2">
                          <span class="badge badge-soft px-3 py-2 me-2"><i class="fa-solid fa-user-plus"></i> Form</span>
                          <h6 class="m-0 fw-bold">Form Rekrutmen</h6>
                      </div>
                      <a href="javascript:history.back()" class="btn btn-sm btn-outline-secondary rounded-pill">
                          <i class="fa-solid fa-arrow-left"></i> Kembali
                      </a>
                  </div>

                  <div class="card-body p-4">
                      <?php if (!empty($d_pkkpokja)): ?>
                          <!-- Arahkan ke aksi_rekrutmen() -->
                          <form id="formRekrutmen" action="<?= site_url('rekrutmen') ?>" method="post" enctype="multipart/form-data" novalidate>
                              <?= csrf_field(); ?>
                              <?php $validation = session('validation') ?? \Config\Services::validation(); ?>

                              <div class="row g-3 mb-3">
                                  <!-- Nama -->
                                  <div class="col-md-6">
                                      <label class="form-label required" for="nama_lengkap">Nama Lengkap</label>
                                      <input id="nama_lengkap" type="text" name="nama_lengkap" autocomplete="name"
                                          class="form-control form-soft <?= $validation->hasError('nama_lengkap') ? 'is-invalid' : '' ?>"
                                          value="<?= old('nama_lengkap') ?>" placeholder="Masukkan nama lengkap..." required autofocus>
                                      <div class="invalid-feedback"><?= $validation->getError('nama_lengkap') ?></div>
                                  </div>

                                  <!-- NIK -->
                                  <div class="col-md-6">
                                      <label class="form-label required" for="nik">NIK (16 digit)</label>
                                      <input id="nik" type="text" name="nik" maxlength="16" inputmode="numeric" pattern="\d{16}"
                                          class="form-control form-soft <?= $validation->hasError('nik') ? 'is-invalid' : '' ?>"
                                          value="<?= old('nik') ?>" placeholder="Masukkan NIK..." required>
                                      <div class="invalid-feedback"><?= $validation->getError('nik') ?></div>
                                  </div>

                                  <!-- Alamat -->
                                  <div class="col-12">
                                      <label class="form-label required" for="alamat">Alamat</label>
                                      <textarea id="alamat" name="alamat" rows="2"
                                          class="form-control form-soft <?= $validation->hasError('alamat') ? 'is-invalid' : '' ?>"
                                          placeholder="Masukkan alamat..." required><?= old('alamat') ?></textarea>
                                      <div class="invalid-feedback"><?= $validation->getError('alamat') ?></div>
                                  </div>

                                  <!-- No HP -->
                                  <div class="col-md-6">
                                      <label class="form-label" for="no_hp">No. HP (WhatsApp)</label>
                                      <input id="no_hp" type="tel" name="no_hp" autocomplete="tel"
                                          class="form-control form-soft <?= $validation->hasError('no_hp') ? 'is-invalid' : '' ?>"
                                          value="<?= old('no_hp') ?>" placeholder="08xxxxxxxxxx">
                                      <div class="invalid-feedback"><?= $validation->getError('no_hp') ?></div>
                                      <div class="help-text">Masukkan nomor aktif (opsional).</div>
                                  </div>

                                  <!-- Pilih Pokja -->
                                  <div class="col-12 col-md-6 select-pokja-col">
                                      <label class="form-label required" for="id_pkkpokja">Pilih Pokja</label>
                                      <select id="id_pkkpokja" name="id_pkkpokja"
                                          class="form-select form-soft <?= $validation->hasError('id_pkkpokja') ? 'is-invalid' : '' ?>"
                                          required>
                                          <option value="">-- Pilih Pokja --</option>
                                          <?php foreach ($d_pkkpokja as $p): ?>
                                              <option value="<?= (int)$p['id_pkkpokja'] ?>"
                                                  <?= (string)old('id_pkkpokja') === (string)$p['id_pkkpokja'] ? 'selected' : '' ?>>
                                                  <?= esc($p['kode']) ?> — <?= esc($p['nama']) ?>
                                              </option>
                                          <?php endforeach; ?>
                                      </select>
                                      <div class="invalid-feedback"><?= $validation->getError('id_pkkpokja') ?></div>
                                      <div class="help-text">Pilih satu Pokja yang paling sesuai.</div>
                                  </div>
                              </div>

                              <div class="d-flex justify-content-end gap-2 mt-3">
                                  <button type="reset" class="btn btn-outline-secondary rounded-pill">
                                      <i class="fa-solid fa-rotate-left"></i> Reset
                                  </button>
                                  <button type="submit" class="btn btn-gradient rounded-pill" id="btnSubmitForm">
                                      <i class="fa-solid fa-paper-plane"></i> Kirim
                                  </button>
                              </div>
                          </form>
                      <?php else: ?>
                          <div class="text-center py-5">
                              <img src="<?= base_url('assets/img/icons-empty.png') ?>" alt="empty" style="width:120px;height:auto;opacity:.9;">
                              <div class="mt-3 text-muted">Belum ada data Pokja aktif.</div>
                              <div class="mt-4">
                                  <a href="<?= site_url('admin/rekrutmen/pokja/create') ?>" class="btn btn-gradient px-4 py-2 rounded-pill">
                                      <i class="fas fa-plus-circle me-2"></i> Tambah Pokja
                                  </a>
                              </div>
                          </div>
                      <?php endif; ?>
                  </div>
              </div>
          </div>


          <style>
              .stat-card {
                  border: 0;
                  border-radius: 18px;
                  box-shadow: 0 10px 24px rgba(15, 23, 42, .08);
                  overflow: hidden;
                  position: relative
              }

              .stat-card::before {
                  content: "";
                  position: absolute;
                  left: 0;
                  top: 0;
                  right: 0;
                  height: 3px;
                  background: linear-gradient(90deg, rgba(78, 115, 223, .6), rgba(28, 200, 138, .6));
                  opacity: .5
              }

              .chip-soft {
                  display: inline-flex;
                  align-items: center;
                  gap: .4rem;
                  padding: .35rem .6rem;
                  border-radius: 999px;
                  background: rgba(78, 115, 223, .08);
                  border: 1px solid rgba(78, 115, 223, .2);
                  color: #4e73df;
                  font-weight: 600;
                  font-size: .8rem
              }

              .display-number {
                  font-weight: 800;
                  letter-spacing: .5px
              }

              .mini-list {
                  list-style: none;
                  margin: 0;
                  padding: 0
              }

              .mini-list li {
                  display: flex;
                  align-items: center;
                  gap: .75rem;
                  padding: .5rem 0;
                  border-bottom: 1px dashed #e5e7eb
              }

              .mini-list li:last-child {
                  border-bottom: none
              }

              .avatar-initial {
                  width: 36px;
                  height: 36px;
                  border-radius: 10px;
                  display: grid;
                  place-items: center;
                  font-weight: 700;
                  background: linear-gradient(135deg, #eef2ff, #e6fffb);
                  color: #334155;
                  border: 1px solid #e5e7eb
              }

              .text-sub {
                  color: #6b7280;
                  font-size: .85rem
              }

              .btn-gradient {
                  background: linear-gradient(135deg, #4e73df, #1cc88a);
                  color: #fff !important;
                  border: 0;
                  border-radius: 999px;
                  padding: .45rem .9rem
              }

              .btn-gradient:hover {
                  filter: saturate(1.05)
              }

              /* default: tidak ada scroll horizontal */
              .smart-scroll {
                  overflow-x: hidden;
              }

              /* diaktifkan via JS saat tinggi > 150px */
              .smart-scroll.allow-x {
                  overflow-x: auto;
              }
          </style>

          <div class="col-xl-4 col-lg-3">
              <div class="card stat-card h-100">
                  <div class="card-body">
                      <div class="d-flex justify-content-between align-items-center mb-2">
                          <h6 class="m-0 fw-bold">Status Pendaftaran</h6>
                          <span class="chip-soft"><i class="fa-solid fa-bolt me-1"></i> Live</span>
                      </div>

                      <div class="mb-1 display-5 display-number"><?= number_format($totalPendaftar, 0, ',', '.') ?></div>
                      <div class="text-sub mb-3">orang sudah mendaftar</div>

                      <?php if (!empty($d_rekrut)): ?>
                          <div class="mb-2 small fw-semibold text-uppercase text-muted">Pendaftar Terbaru</div>

                          <div class="smart-scroll">
                              <ul class="mini-list mb-3">
                                  <?php foreach ($d_rekrut as $r):
                                        $nama  = trim($r['nama_lengkap'] ?? '—');
                                        $inits = mb_strtoupper(mb_substr($nama, 0, 1, 'UTF-8'));

                                        // JIKA DB SIMPAN UTC (paling umum di server):
                                        $created = !empty($r['created_at'])
                                            ? Time::parse((string)$r['created_at'], 'UTC')->setTimezone('Asia/Jakarta')
                                            : null;

                                        // JIKA DB SUDAH SIMPAN WIB, ganti baris parse di atas menjadi:
                                        // $created = !empty($r['created_at']) ? Time::parse((string)$r['created_at'], 'Asia/Jakarta') : null;

                                        $waktu = $created ? $created->humanize($nowWIB) : 'baru saja';
                                    ?>
                                      <li>
                                          <div class="avatar-initial"><?= esc($inits) ?></div>
                                          <div class="flex-grow-1">
                                              <div class="fw-semibold"><?= esc($nama) ?></div>
                                              <div class="text-sub">
                                                  <i class="fa-regular fa-clock me-1"></i>
                                                  <?= esc($waktu) ?>
                                              </div>
                                          </div>
                                      </li>
                                  <?php endforeach; ?>
                              </ul>
                          </div>

                      <?php else: ?>
                          <div class="text-sub">Belum ada pendaftar.</div>
                      <?php endif; ?>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <script>
      // Preview pas foto + cek ukuran 1MB
      (function() {
          const input = document.getElementById('pas_foto');
          const prev = document.getElementById('prev_pas_foto');
          if (!input || !prev) return;
          input.addEventListener('change', e => {
              const f = e.target.files?.[0];
              if (!f) return;
              if (f.size > 1024 * 1024) {
                  if (window.Swal) Swal.fire('Ukuran terlalu besar', 'Maksimal 1MB', 'warning');
                  e.target.value = '';
                  prev.classList.add('d-none');
                  prev.src = '';
                  return;
              }
              const r = new FileReader();
              r.onload = ev => {
                  prev.src = ev.target.result;
                  prev.classList.remove('d-none');
              };
              r.readAsDataURL(f);
          });
      })();

      // NIK hanya digit (maks 16), konfirmasi submit + kunci UI
      (function() {
          const form = document.getElementById('formRekrutmen');
          const btn = document.getElementById('btnSubmitForm');
          if (!form) return;

          const nikInput = form.querySelector('#nik');
          if (nikInput) {
              const keepDigits = () => {
                  const d = (nikInput.value || '').replace(/\D/g, '').slice(0, 16);
                  if (d !== nikInput.value) nikInput.value = d;
              };
              nikInput.setAttribute('inputmode', 'numeric');
              nikInput.setAttribute('pattern', '\\d{16}');
              nikInput.setAttribute('maxlength', '16');
              nikInput.addEventListener('input', keepDigits);
              nikInput.addEventListener('blur', keepDigits);
              nikInput.addEventListener('paste', () => setTimeout(keepDigits, 0));
          }

          if (btn && window.Swal) {
              btn.addEventListener('click', function(ev) {
                  ev.preventDefault();
                  Swal.fire({
                          title: 'Kirim formulir?',
                          icon: 'question',
                          showCancelButton: true,
                          confirmButtonText: 'Kirim',
                          cancelButtonText: 'Batal'
                      })
                      .then(r => {
                          if (r.isConfirmed) form.requestSubmit();
                      });
              });
          }

          form.addEventListener('submit', function() {
              // Matikan tombol agar tidak double submit
              form.querySelectorAll('button, input[type="submit"], input[type="button"], input[type="reset"]').forEach(b => b.disabled = true);
              // Kunci field (tanpa men-disable select/checkbox supaya value tetap terkirim)
              form.querySelectorAll('input:not([type="hidden"]), select, textarea').forEach(el => {
                  el.style.pointerEvents = 'none';
                  const type = (el.type || '').toLowerCase();
                  if (el.tagName !== 'SELECT' && !['checkbox', 'radio', 'file', 'hidden', 'submit', 'button', 'reset'].includes(type)) {
                      el.readOnly = true;
                  }
              });
              const sbtn = document.getElementById('btnSubmitForm');
              if (sbtn) {
                  sbtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Mengirim...';
                  sbtn.classList.add('disabled');
                  sbtn.setAttribute('aria-disabled', 'true');
              }
          }, {
              once: true
          });
      })();

      // scroll pendaftar overflow-x
      document.addEventListener('DOMContentLoaded', function() {
          const box = document.querySelector('.smart-scroll');
          if (!box) return;

          const THRESHOLD = 150; // px

          const apply = () => {
              const needsX = box.scrollHeight > THRESHOLD;
              box.classList.toggle('allow-x', needsX);
          };

          // Jalankan awal
          apply();

          // Update ketika ukuran / konten berubah
          if ('ResizeObserver' in window) {
              new ResizeObserver(apply).observe(box);
          } else {
              window.addEventListener('resize', apply, {
                  passive: true
              });
          }
          new MutationObserver(apply).observe(box, {
              childList: true,
              subtree: true,
              characterData: true
          });
      });
  </script>

  <?= $this->endSection() ?>