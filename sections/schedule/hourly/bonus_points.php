<?php

//------------------------ Update Bonus Points -------------------------//
// calcuation:
// Size * (0.0754 + (0.1207 * ln(1 + seedtime)/ (seeders ^ 0.55)))
// Size (convert from bytes to GB) is in torrents
// Seedtime (convert to hours to days) is in xbt_snatched
// Seeders is in torrents
$DB->query("
SELECT *
FROM users_main as um
JOIN users_info as i on um.ID = i.UserID
WHERE 
	um.Enabled = '1'
	AND i.DisablePoints = '0'
");

$DB->query("
UPDATE users_main AS um
LEFT JOIN (
	SELECT
		xfu.uid AS ID,
		SUM((t.Size / (1024 * 1024 * 1024)) * (
				0.0754 + (
					LN(1 + (xs.seedtime / (24))) / (POW(GREATEST(t.Seeders, 1), 0.55))
				)
			)
		) AS NewPoints
	FROM
		xbt_files_users AS xfu
		JOIN users_info AS ui ON ui.UserID = xfu.uid
		JOIN xbt_snatched AS xs ON xs.fid = xfu.fid
		JOIN torrents AS t ON t.ID = xfu.fid
	WHERE
		xfu.active = '1'
		AND xfu.remaining = 0
		AND ui.DisablePoints = '0'
	GROUP BY
		xfu.uid
) AS p ON um.ID = p.ID
SET um.BonusPoints=um.BonusPoints + p.NewPoints");

$DB->query("SELECT UserID FROM users_info WHERE DisablePoints = '0'");
if ($DB->has_results()) {
	while(list($UserID) = $DB->next_record()) {
		$Cache->delete_value('user_info_heavy_'.$UserID);
	}
}
