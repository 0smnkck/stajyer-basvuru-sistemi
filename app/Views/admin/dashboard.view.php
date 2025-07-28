<h1>Gelen Staj Başvuruları</h1>

<form method="GET" action="/stajyer-basvuru-sistemi/public/admin/dashboard" class="mb-4 p-3 bg-light border rounded">
    <div class="row g-3 align-items-center">
        <div class="col-md-5">
            <label for="search" class="form-label">Ara (Ad/Email):</label>
            <input type="text" id="search" name="search" class="form-control" value="<?= htmlspecialchars($filters['search'] ?? '') ?>" placeholder="Ad veya email girin...">
        </div>
        <div class="col-md-5">
            <label for="status" class="form-label">Duruma Göre Filtrele:</label>
            <select id="status" name="status" class="form-select">
                <option value="">Tümü</option>
                <option value="Bekliyor" <?= ($filters['status'] ?? '') === 'Bekliyor' ? 'selected' : '' ?>>Bekliyor</option>
                <option value="Onaylandı" <?= ($filters['status'] ?? '') === 'Onaylandı' ? 'selected' : '' ?>>Onaylandı</option>
                <option value="Reddedildi" <?= ($filters['status'] ?? '') === 'Reddedildi' ? 'selected' : '' ?>>Reddedildi</option>
            </select>
        </div>
        <div class="col-md-2 d-grid">
             <label for="status" class="form-label">&nbsp;</label> <button type="submit" class="btn btn-primary">Filtrele</button>
        </div>
    </div>
</form>

<table class="table table-striped table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Ad Soyad</th>
            <th>Email</th>
            <th>Başvuru Tarihi</th>
            <th>Durum</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($basvurular as $basvuru): ?>
            <tr>
                <td><?= $basvuru['id'] ?></td>
                <td><a href="/stajyer-basvuru-sistemi/public/admin/basvuru?id=<?= $basvuru['id'] ?>"><?= htmlspecialchars($basvuru['ad_soyad']) ?></a></td>
                <td><?= htmlspecialchars($basvuru['email']) ?></td>
                <td><?= date('d.m.Y H:i', strtotime($basvuru['basvuru_tarihi'])) ?></td>
                <td><?= htmlspecialchars($basvuru['durum']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <?php if (isset($totalPages)): ?>
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <?php
                // Mevcut filtreleri koruyarak sayfa linki oluşturma
                $queryParams = array_merge($filters, ['page' => $i]);
                ?>
                <li class="page-item <?= ($i == ($currentPage ?? 1)) ? 'active' : '' ?>">
                    <a class="page-link" href="?<?= http_build_query($queryParams) ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        <?php endif; ?>
    </ul>
</nav>