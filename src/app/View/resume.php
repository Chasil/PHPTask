<!DOCTYPE html>
<html lang=\"en\">
<head>
	<meta charset=\"UTF-8\">
	<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
	<title>GitHub Resume</title>
</head>
<body>
	<h1>GitHub Resume for <?= htmlspecialchars($data['user']['login']) ?></h1>
	<p>Website:
        <a href="<?= htmlspecialchars($data['user']['blog']) ?>"><?= htmlspecialchars($data['user']['blog']) ?></a>
    </p>
	<h2>Repositories [<?= count($data['repositories']) ?>]:</h2>
	<ul>
		<?php foreach ($data['repositories'] as $repo): ?>
			<li>
                <a href="<?= htmlspecialchars($repo['html_url'] ?? '') ?>">
                    <?= htmlspecialchars($repo['name'] ?? '') ?>
                </a>: <?= htmlspecialchars($repo['description'] ?? '') ?>
            </li>
		<?php endforeach; ?>
	</ul>
	<h2>Languages:</h2>
	<ul>
		<?php foreach ($data['languages'] as $language => $percentage): ?>
			<li><?= htmlspecialchars($language) ?>: <?= $percentage ?>%</li>
		<?php endforeach; ?>
	</ul>
</body>
</html>