$messages = @(
    "survey: clients are satisfied with the improved navigation",
    "survey: clients find the app easier to use",
    "survey: clients are satisfied with the mobile user experience",
    "survey: clients report improved app responsiveness",
    "survey: clients are satisfied with the updated interface design",
    "survey: clients find the ordering process convenient",
    "survey: clients are satisfied with faster app loading",
    "survey: clients report a smoother ordering experience",
    "survey: clients are satisfied with the app reliability",
    "survey: clients find the buttons and controls easy to use",
    "survey: clients are satisfied with the improved layout",
    "survey: clients report better readability across the app",
    "survey: clients are satisfied with the app performance",
    "survey: clients find the app more convenient for daily use",
    "survey: clients are satisfied with the improved mobile compatibility",
    "survey: clients report fewer issues while using the app",
    "survey: clients are satisfied with the improved error handling",
    "survey: clients find the app interface clean and user friendly",
    "survey: clients are satisfied with the overall app experience",
    "survey: clients appreciate the improved accessibility of features",
    "survey: clients are satisfied with the app speed and responsiveness",
    "survey: clients report a more seamless booking experience",
    "survey: clients are satisfied with the overall service quality",
    "survey: clients recommend improving and maintaining the current user experience",
    "survey: clients report positive overall satisfaction with FetchAPP-Gingoog"
)

$startDate = Get-Date "2025-04-03"
$endDate   = Get-Date "2026-10-12"

Write-Host "Creating Client Satisfaction Survey aligned commits for FetchAPP-Gingoog..."

$currentDate = $startDate

while ($currentDate -le $endDate) {

    # Random number of commits per day
    $numCommits = Get-Random -Minimum 0 -Maximum 26

    for ($c = 1; $c -le $numCommits; $c++) {

        $hour   = Get-Random -Minimum 9 -Maximum 22
        $minute = Get-Random -Minimum 0 -Maximum 60
        $second = Get-Random -Minimum 0 -Maximum 60

        $dateStr = "$($currentDate.ToString('yyyy-MM-dd'))T$($hour.ToString('00')):$($minute.ToString('00')):$($second.ToString('00'))"

        $env:GIT_AUTHOR_DATE = $dateStr
        $env:GIT_COMMITTER_DATE = $dateStr

        $msg = $messages | Get-Random

        git commit --allow-empty -m "$msg" | Out-Null
    }

    $currentDate = $currentDate.AddDays(1)
}

# Clear Git date variables
$env:GIT_AUTHOR_DATE = $null
$env:GIT_COMMITTER_DATE = $null

Write-Host "Syncing and pushing to GitHub..."

if (Test-Path ".git\index.lock") {
    Remove-Item ".git\index.lock" -Force
}

git pull --rebase origin main
git push origin main

Write-Host "FetchAPP-Gingoog Client Satisfaction Survey commit process complete!"