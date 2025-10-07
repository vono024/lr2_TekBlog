<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'JetBrains All Products Pack',
                'slug' => 'jetbrains-all-products-pack',
                'category' => 'subscription',
                'emoji' => '🚀',
                'price' => 249.00,
                'period' => 'рік',
                'description' => 'Доступ до всіх IDE від JetBrains: IntelliJ IDEA, PhpStorm, WebStorm, PyCharm та інші',
                'full_description' => 'Отримайте повний доступ до всіх інструментів JetBrains для професійної розробки. Включає всі IDE, плагіни та оновлення протягом року.',
                'features' => json_encode(['Всі IDE JetBrains', 'Оновлення протягом року', 'Пріоритетна підтримка', 'Навчальні матеріали', 'Комерційна ліцензія']),
                'is_popular' => true,
            ],
            [
                'name' => 'GitHub Copilot',
                'slug' => 'github-copilot',
                'category' => 'subscription',
                'emoji' => '🤖',
                'price' => 10.00,
                'period' => 'місяць',
                'description' => 'AI-асистент для програмування на базі OpenAI',
                'full_description' => 'GitHub Copilot - це AI-помічник, який допомагає писати код швидше. Підтримує десятки мов програмування та інтегрується з популярними редакторами.',
                'features' => json_encode(['Автодоповнення коду', 'Генерація функцій', 'Підтримка всіх мов', 'Інтеграція з VS Code', 'Чат з AI']),
                'is_popular' => true,
            ],
            [
                'name' => 'MacBook Pro M3',
                'slug' => 'macbook-pro-m3',
                'category' => 'device',
                'emoji' => '💻',
                'price' => 1999.00,
                'period' => null,
                'description' => 'Потужний ноутбук для розробників з чіпом M3 Pro',
                'full_description' => 'MacBook Pro з чіпом M3 Pro - ідеальний вибір для професійних розробників. Неймовірна продуктивність, тривалість роботи від батареї та чудовий дисплей.',
                'features' => json_encode(['M3 Pro чіп', '18GB RAM', '512GB SSD', 'Retina дисплей', '18 годин роботи']),
                'is_popular' => false,
            ],
            [
                'name' => 'Claude Pro',
                'slug' => 'claude-pro',
                'category' => 'subscription',
                'emoji' => '🧠',
                'price' => 20.00,
                'period' => 'місяць',
                'description' => 'Преміум доступ до AI-асистента Claude від Anthropic',
                'full_description' => 'Claude Pro надає необмежений доступ до найрозумнішого AI-асистента. Ідеально для програмістів, письменників та дослідників.',
                'features' => json_encode(['Необмежені запити', 'Пріоритетний доступ', 'Розширений контекст', 'Нові можливості', 'Робота з файлами']),
                'is_popular' => true,
            ],
            [
                'name' => 'Mechanical Keyboard RGB',
                'slug' => 'mechanical-keyboard-rgb',
                'category' => 'device',
                'emoji' => '⌨️',
                'price' => 159.00,
                'period' => null,
                'description' => 'Механічна клавіатура для комфортного кодингу',
                'full_description' => 'Преміальна механічна клавіатура з Cherry MX перемикачами. RGB підсвітка, програмовані макроси та ергономічний дизайн для тривалої роботи.',
                'features' => json_encode(['Cherry MX перемикачі', 'RGB підсвітка', 'Програмовані клавіші', 'USB-C', 'N-Key Rollover']),
                'is_popular' => false,
            ],
            [
                'name' => 'Figma Professional',
                'slug' => 'figma-professional',
                'category' => 'subscription',
                'emoji' => '🎨',
                'price' => 12.00,
                'period' => 'місяць',
                'description' => 'Професійний інструмент для UI/UX дизайну',
                'full_description' => 'Figma Professional - найкращий інструмент для дизайну інтерфейсів. Командна робота в реальному часі, версіонування та інтеграція з розробкою.',
                'features' => json_encode(['Необмежені проєкти', 'Версіонування', 'Командна робота', 'Dev Mode', 'Плагіни']),
                'is_popular' => false,
            ],
            [
                'name' => 'iPhone 15 Pro',
                'slug' => 'iphone-15-pro',
                'category' => 'device',
                'emoji' => '📱',
                'price' => 999.00,
                'period' => null,
                'description' => 'Потужний смартфон з A17 Pro чіпом',
                'full_description' => 'iPhone 15 Pro з чіпом A17 Pro - ідеальний вибір для мобільної розробки та тестування додатків. Титановий корпус та найкраща камера.',
                'features' => json_encode(['A17 Pro чіп', '256GB пам\'яті', 'Titanium корпус', 'ProMotion дисплей', '5G']),
                'is_popular' => true,
            ],
            [
                'name' => 'Docker Desktop Pro',
                'slug' => 'docker-desktop-pro',
                'category' => 'subscription',
                'emoji' => '🐳',
                'price' => 7.00,
                'period' => 'місяць',
                'description' => 'Професійна версія Docker Desktop',
                'full_description' => 'Docker Desktop Pro для професійної контейнеризації додатків. Розширені можливості для команд розробників.',
                'features' => json_encode(['Image Access Management', 'Розширена підтримка', 'Kubernetes', 'Docker Hub Pro', 'Командні функції']),
                'is_popular' => false,
            ],
            [
                'name' => 'Ultrawide Monitor 34"',
                'slug' => 'ultrawide-monitor-34',
                'category' => 'device',
                'emoji' => '🖥️',
                'price' => 599.00,
                'period' => null,
                'description' => 'Широкоформатний монітор для продуктивності',
                'full_description' => 'Ultrawide монітор 34" з роздільністю 3440x1440. Ідеально для багатозадачності, кодингу та роботи з великими проєктами.',
                'features' => json_encode(['3440x1440 роздільність', '144Hz', 'IPS панель', 'USB-C підключення', 'Регулювання висоти']),
                'is_popular' => false,
            ],
            [
                'name' => 'Vercel Pro',
                'slug' => 'vercel-pro',
                'category' => 'subscription',
                'emoji' => '▲',
                'price' => 20.00,
                'period' => 'місяць',
                'description' => 'Платформа для деплою та хостингу',
                'full_description' => 'Vercel Pro - найкраща платформа для деплою Next.js та інших фронтенд додатків. Миттєвий деплой, глобальна CDN та аналітика.',
                'features' => json_encode(['Необмежені деплої', 'Глобальна CDN', 'Аналітика', 'Командна робота', 'Більше ресурсів']),
                'is_popular' => false,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
