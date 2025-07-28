<div class="card shadow-sm">
    <div class="card-header">
        <h2 class="mb-0">Başvuru Detayı: <?= htmlspecialchars($basvuru['ad_soyad']) ?></h2>
    </div>
    <div class="card-body">
        
        <dl class="row">
            <dt class="col-sm-3 text-sm-end">Başvuru ID:</dt>
            <dd class="col-sm-9"><?= $basvuru['id'] ?></dd>

            <dt class="col-sm-3 text-sm-end">E-posta:</dt>
            <dd class="col-sm-9"><?= htmlspecialchars($basvuru['email']) ?></dd>

            <dt class="col-sm-3 text-sm-end">Telefon:</dt>
            <dd class="col-sm-9"><?= htmlspecialchars($basvuru['telefon'] ?? 'Belirtilmemiş') ?></dd>

            <dt class="col-sm-3 text-sm-end">Üniversite:</dt>
            <dd class="col-sm-9"><?= htmlspecialchars($basvuru['universite'] ?? 'Belirtilmemiş') ?></dd>

            <dt class="col-sm-3 text-sm-end">Bölüm:</dt>
            <dd class="col-sm-9"><?= htmlspecialchars($basvuru['bolum'] ?? 'Belirtilmemiş') ?></dd>

            <dt class="col-sm-3 text-sm-end">Başvuru Tarihi:</dt>
            <dd class="col-sm-9"><?= date('d.m.Y H:i', strtotime($basvuru['basvuru_tarihi'])) ?></dd>

            <dt class="col-sm-3 text-sm-end">Mevcut Durum:</dt>
            <dd class="col-sm-9">
                <?php
                    $durum = htmlspecialchars($basvuru['durum']);
                    $badge_class = 'bg-secondary'; // Varsayılan
                    if ($durum === 'Onaylandı') $badge_class = 'bg-success';
                    if ($durum === 'Reddedildi') $badge_class = 'bg-danger';
                ?>
                <span class="badge <?= $badge_class ?>"><?= $durum ?></span>
            </dd>
        </dl>

        <?php if (!empty($basvuru['on_yazi'])): ?>
        <hr>
        <h4>Ön Yazı</h4>
        <p class="bg-light p-3 rounded"><?= nl2br(htmlspecialchars($basvuru['on_yazi'])) ?></p>
        <?php endif; ?>

        <?php if (!empty($basvuru['staj_belgesi_yolu'])): ?>
        <hr>
        <h4>Ekli Belge</h4>
        <a href="/stajyer-basvuru-sistemi/<?= htmlspecialchars($basvuru['staj_belgesi_yolu']) ?>" class="btn btn-outline-primary" target="_blank">Zorunlu Staj Belgesini Görüntüle</a>
        <?php endif; ?>

        <hr>
        <div class="actions">
            <h4>İşlemler</h4>
            <div class="d-flex gap-2">
                <form action="/stajyer-basvuru-sistemi/public/admin/basvuru/guncelle" method="POST">
                    <input type="hidden" name="id" value="<?= $basvuru['id'] ?>">
                    <input type="hidden" name="durum" value="Onaylandı">
                    <button type="submit" class="btn btn-success">Onayla</button>
                </form>
                <form action="/stajyer-basvuru-sistemi/public/admin/basvuru/guncelle" method="POST">
                    <input type="hidden" name="id" value="<?= $basvuru['id'] ?>">
                    <input type="hidden" name="durum" value="Reddedildi">
                    <button type="submit" class="btn btn-danger">Reddet</button>
                </form>
            </div>
        </div>

    </div>
    <div class="card-footer text-start">
        <a href="/stajyer-basvuru-sistemi/public/admin/dashboard" class="btn btn-secondary">← Listeye Geri Dön</a>
    </div>
</div>