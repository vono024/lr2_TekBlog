<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $products = [
            [
                'name' => 'JetBrains All Products Pack',
                'category' => 'subscription',
                'emoji' => '🚀',
                'price' => 249.00,
                'period' => 'рік',
                'description' => 'Доступ до всіх IDE від JetBrains: IntelliJ IDEA, PhpStorm, WebStorm, PyCharm та інші',
                'features' => ['Всі IDE JetBrains', 'Оновлення протягом року', 'Пріоритетна підтримка', 'Навчальні матеріали'],
            ],
            [
                'name' => 'GitHub Copilot',
                'category' => 'subscription',
                'emoji' => '🤖',
                'price' => 10.00,
                'period' => 'місяць',
                'description' => 'AI-асистент для програмування на базі OpenAI',
                'features' => ['Автодоповнення коду', 'Генерація функцій', 'Підтримка всіх мов', 'Інтеграція з VS Code'],
            ],
            [
                'name' => 'MacBook Pro M3',
                'category' => 'device',
                'emoji' => '💻',
                'price' => 1999.00,
                'period' => null,
                'description' => 'Потужний ноутбук для розробників з чіпом M3 Pro',
                'features' => ['M3 Pro чіп', '18GB RAM', '512GB SSD', 'Retina дисплей'],
            ],
            [
                'name' => 'Claude Pro',
                'category' => 'subscription',
                'emoji' => '🧠',
                'price' => 20.00,
                'period' => 'місяць',
                'description' => 'Преміум доступ до AI-асистента Claude від Anthropic',
                'features' => ['Необмежені запити', 'Пріоритетний доступ', 'Розширений контекст', 'Нові можливості'],
            ],
            [
                'name' => 'Mechanical Keyboard',
                'category' => 'device',
                'emoji' => '⌨️',
                'price' => 159.00,
                'period' => null,
                'description' => 'Механічна клавіатура для комфортного кодингу',
                'features' => ['Cherry MX перемикачі', 'RGB підсвітка', 'Програмовані клавіші', 'USB-C'],
            ],
            [
                'name' => 'Figma Professional',
                'category' => 'subscription',
                'emoji' => '🎨',
                'price' => 12.00,
                'period' => 'місяць',
                'description' => 'Професійний інструмент для UI/UX дизайну',
                'features' => ['Необмежені проєкти', 'Версіонування', 'Командна робота', 'Dev Mode'],
            ],
        ];

        $product = fake()->randomElement($products);
        $name = $product['name'];

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $product['description'],
            'full_description' => fake()->paragraphs(3, true),
            'price' => $product['price'],
            'period' => $product['period'],
            'category' => $product['category'],
            'emoji' => $product['emoji'],
            'features' => json_encode($product['features']),
            'is_popular' => fake()->boolean(30),
        ];
    }
}
