@echo off 
start http://hongjiu.com/crontab/index.php?model=hour
ping -n 5 127.1 >nul 5>nul 
taskkill /f /im IEXPLORE.exe 
exit