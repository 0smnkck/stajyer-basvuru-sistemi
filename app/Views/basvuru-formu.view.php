<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h1 class="card-title text-center mb-4">Stajyer Başvuru Formu</h1>

                <form action="/stajyer-basvuru-sistemi/public/basvuru" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="ad_soyad" class="form-label">Ad Soyad</label>
                        <input type="text" id="ad_soyad" name="ad_soyad" class="form-control" value="<?= htmlspecialchars($old['ad_soyad'] ?? '') ?>" required>
                        <?php if (isset($errors['ad_soyad'])): ?>
                            <div class="form-text text-danger"><?= $errors['ad_soyad'] ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-posta</label>
                        <input type="email" id="email" name="email" class="form-control" value="<?= htmlspecialchars($old['email'] ?? '') ?>" required>
                        <?php if (isset($errors['email'])): ?>
                            <div class="form-text text-danger"><?= $errors['email'] ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="telefon" class="form-label">Telefon</label>
                        <input type="tel" id="telefon" name="telefon" class="form-control" value="<?= htmlspecialchars($old['telefon'] ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="universite" class="form-label">Üniversite</label>
                        <input type="text" id="universite" name="universite" class="form-control" value="<?= htmlspecialchars($old['universite'] ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="bolum" class="form-label">Bölüm</label>
                        <input type="text" id="bolum" name="bolum" class="form-control" value="<?= htmlspecialchars($old['bolum'] ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="on_yazi" class="form-label">Ön Yazı</label>
                        <textarea id="on_yazi" name="on_yazi" class="form-control" rows="5"><?= htmlspecialchars($old['on_yazi'] ?? '') ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="staj_belgesi" class="form-label">Zorunlu Staj Belgesi (Varsa, Sadece PDF)</label>
                        <input type="file" id="staj_belgesi" name="staj_belgesi" class="form-control" accept=".pdf">
                    </div>
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">Başvuruyu Gönder</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>