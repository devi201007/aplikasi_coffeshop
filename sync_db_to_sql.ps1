$workspace = 'C:\xampp\htdocs\aplikasi_coffeshop\kopi_senja'
$mysqlDump = 'C:\xampp\mysql\bin\mysqldump.exe'
$dbName = 'kedai_kopi'
$outputFile = Join-Path $workspace 'database.sql'
$tempFile = Join-Path $workspace 'database_sync_temp.sql'
$intervalSeconds = 5

while ($true) {
    try {
        if (-not (Test-Path $mysqlDump)) {
            Write-Host "mysqldump not found at $mysqlDump"
            Start-Sleep -Seconds $intervalSeconds
            continue
        }

        & $mysqlDump --user=root --host=localhost --databases $dbName --result-file=$tempFile --skip-comments --skip-set-charset --no-tablespaces 2>$null

        if (Test-Path $tempFile) {
            Copy-Item $tempFile $outputFile -Force
            Remove-Item $tempFile -Force -ErrorAction SilentlyContinue
            Write-Host "Database synced to $outputFile at $(Get-Date -Format 'yyyy-MM-dd HH:mm:ss')"
        }
    }
    catch {
        Write-Host "Sync failed: $($_.Exception.Message)"
    }

    Start-Sleep -Seconds $intervalSeconds
}
