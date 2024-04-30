# SHABLONIZATOR3000

## Описание проекта

SHABLONIZATOR3000 - это веб-сервис, который автоматизирует процесс заполнения дневника практик в формате DOCX файла по предоставленному шаблону. Он предназначен для студентов и всех, кто нуждается в ведении практического дневника. Проект использует PHP, HTML, CSS, Python (с библиотеками pymorphy2, docxtpl) и базу данных MySQL для эффективной работы.

## Установка и развертывание проекта

1. Скачайте Python 3.8 на [официальном сайте Python](https://www.python.org/downloads/release/python-380/)(Windows x86 executable installer или Windows x86-64 executable installer).
2. Запустите файл установки - python-3.8.0.exe. Снизу нажмите "Add Python 3.8 to PATH". Далее перейдите в "Customize Installation"(Должны стоять галочки на: Documentation, pip, tcl/tk and IDLE, Python test suite, pylauncher), нажмите Next и дождитесь завершения установки.
3. Откройте PowerShell и выполните следующие команды по очереди:
    ```
    python -m pip install --upgrade pip
    pip install docxtpl
    pip install pymorphy2
    ```
    Обратите внимание, что могут возникнуть проблемы доступа, тогда к вышеперечисленным командам после "install" потребуется добавить --user и запустить каждую команду снова.
4. Установите MAMP для запуска локального сервера. Скачайте и установите MAMP с [официального сайта](https://www.mamp.info/en/downloads/).
5. Откройте PowerShell и перейдите в каталог, куда вы хотите клонировать репозиторий, в случае с MAMP это:
    ```
    cd C:\MAMP\htdocs
    ```
6. Клонируйте репозиторий:
    ```
    git clone https://github.com/extazzzzzy/SHABLONIZATOR3000.git
    ```
7. Скачайте необходимую базу данных по [ссылке(будет позже)](https://cloud.mail.ru/).
8. Запустите MAMP и после успешного запуска сервера нажмите "Open WebStart page". На открытой странице найдите ссылку *phpMyAdmin* и перейдите по ней. В phpMyAdmin сверху нажмите "Import" и выберите ранее скачанную БД. После удачного импорта перейдите по следующему адресу и опробуйте веб-сервис:
    ```
    http://localhost/SHABLONIZATOR3000/pages/auth.php
    ```

---
Команда SHABLONIZATOR3000 © 2024. Создано с любовью и кодом.
