<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach($urls as $url): ?>
    <url>
        <loc><?= htmlspecialchars($url['loc']) ?></loc>
        <priority><?= htmlspecialchars($url['priority']) ?></priority>
    </url>
<?php endforeach; ?>
</urlset>
