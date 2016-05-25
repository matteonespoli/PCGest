@echo off
tasklist /FI "IMAGENAME eq CardListener.exe" 2>NUL | find /I /N "CardListener.exe">NUL
echo %ERRORLEVEL%