# AuditPro - Enterprise Business Maturity Tool

**AuditPro** is a scalable, premium Software-as-a-Service (SaaS) platform built for business consultants, coaches, and agencies to run comprehensive internal and external business audits. Measure growth, optimize processes, and visualize bottlenecks across key business pillars (Revenue, Profit, Order, Influence, and Legacy).

With AuditPro, track a business's exact trajectory via visually stunning radar charts, compare historical growth point-by-point, and get actionable AI-driven development strategies based on customized weighting architectures.

## 🚀 Key Features
- **Dynamic Template Builder**: Build infinitely configurable enterprise-grade questionnaires with branching logic, target benchmark scores, conditional routing, and specific question weightings.
- **Maturity Radar Visualizations**: Compare a company's performance against industry benchmarks or historical audits using interactive Javascript-powered Radar Charts.
- **Multilingual Localization**: Native support for 10 languages including English, German, French, Spanish, Italian, Portuguese, Arabic, Chinese, Russian, and Japanese! Seamless interface switching.
- **PDF Report Generation**: Export beautiful, professional breakdowns mapped with algorithmic recommendations per department for high-ticket clients.
- **Multi-tenant Architecture**: Centrally manage all clients, historic audits, and organizations in a clean, modern SaaS layout.

## 🛠 Tech Stack
- **Framework**: Laravel 11.x, PHP 8.2+
- **Frontend**: Livewire 3 / Volt, Alpine.js, Tailwind CSS (Vanilla)
- **Database**: SQLite / MySQL (Eloquent ORM)
- **Charts**: Chart.js for data visualization
- **PDFs**: Barryvdh\DomPDF

## 📦 Installation & Setup

1. **Clone the repository:**
   ```bash
   git clone https://github.com/mrshahbazdev/audit.git
   cd audit-tool-app
   ```

2. **Install dependencies:**
   ```bash
   composer install
   npm install && npm run build
   ```

3. **Configure Environment:**
   Copy the example environment file and generate a new application key.
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Run Migrations & Seeders:**
   Prepare the database with default pillars, questions, and templates.
   ```bash
   php artisan migrate --seed
   ```

5. **Serve the Application:**
   ```bash
   php artisan serve
   ```

## 📖 Documentation
A complete user guide on the Enterprise Form Builder, conditional logic setup, and algorithmic comparisons is available within the application natively via the **Docs** tab.

## 🛡 License
© 2024 AuditPro SaaS. All rights reserved.
