<p align="center"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://packagist/l/laravel/framework" alt="License"></a>
</p>

# BB-Game 吉祥賓果遊戲系統

一個基於 Laravel 框架開發的遊戲系統，支援會員管理、遊戲下注、期數管理、自動化派彩等功能。

## 功能特色

### 會員系統
- 使用者註冊 / 登入 / 登出
- 密碼修改
- Session 驗證機制

### 遊戲系統
- 吉祥賓果（Bingo）遊戲
- 遊戲下注頁面
- 期數管理（自動拉期數、手動執行）
- 自動化派彩與賽果更新
- 過期注單自動取消

### 管理功能
- 會員帳務查詢
- 期數管理（日期搜尋）
- 注單管理
- 遊戲玩法設定（上下中盤、金木水火土）

### 通知系統
- Telegram 風控警報機器人（虧損超過 500 通知）

## 環境需求

- **PHP** 8.1+
- **Laravel** 10.x
- **MySQL** 5.7+ 或 **MariaDB** 10.3+
- **Composer** 2.x
- **Redis**（可選，用於快取）
- **Git**

## 安裝步驟

### 1. 複製專案

```bash
git clone https://github.com/barrygg11/BB-Game.git
cd BB-Game
```

### 2. 安裝依賴

```bash
composer install
```

### 3. 設定環境變數

```bash
cp .env.example .env
```

編輯 `.env` 檔案，填入以下必要資訊：

```env
APP_NAME=BB-Game
APP_ENV=local
APP_KEY=          # 執行 php artisan key:generate 生成
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bb_game
DB_USERNAME=root
DB_PASSWORD=

REDIS_PASSWORD=null

# Telegram 機器人設定
TELEGRAM_BOT_TOKEN=你的Bot_Token
TELEGRAM_CHAT_ID=你的Chat_ID

# AWS S3（可選）
AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
```

### 4. 生成應用程式金鑰

```bash
php artisan key:generate
```

### 5. 執行資料庫遷移

```bash
php artisan migrate
```

### 6. 啟動開發伺服器

```bash
php artisan serve
```

存取 `http://localhost:8000` 即可開始使用。

## 指令列表

| 指令 | 說明 |
|------|------|
| `php artisan Auto:CreateGameNum {game_type}` | 自動建立遊戲期數 |
| `php artisan Auto:GetResult {game_type}` | 自動抓取並更新賽果 |
| `php artisan Auto:SendMessage {game_type}` | 發送風控警報至 Telegram |
| `php artisan Auto:SendRandGameRets {game_type}` | 自動派彩（亂數結果） |
| `php artisan Update:OrderStatus` | 手動執行過期注單改為取消 |

## 專案結構

```
app/
├── Console/Commands/     # Artisan 指令
├── Http/
│   ├── Controllers/      # 控制器
│   └── Middleware/       # 中間件
├── Models/               # Eloquent 模型
└── classes/              # 輔助類別

config/                   # Laravel 設定檔
database/
├── migrations/           # 資料庫遷移
└── factories/            # 工廠模式
resources/views/          # Blade 視圖
routes/
├── api.php               # API 路由
└── web.php               # Web 路由
tests/Feature/            # 功能測試
```

## 安全性注意

- `.env` 檔案包含敏感資訊，**請勿提交至 Git**
- 定期更換 Telegram Bot Token
- 建議在正式環境將 `APP_DEBUG` 設為 `false`

## 技術棧

- **框架**：Laravel 10.x
- **前端**：Blade 模板 + JavaScript
- **資料庫**：MySQL
- **快取**：File / Redis
- **第三方 API**：Telegram Bot API

## License

MIT License
