<?php
const SOCIALS_LINKS = [
    [
        "title" => "Инстаграм",
        "url" => "#",
        "src" => "/images/instagram.png",
    ],
    [
        "title" => "Телеграм",
        "url" => "#",
        "src" => "/images/telegram.png",
    ],
    [
        "title" => "Вконтакте",
        "url" => "#",
        "src" => "/images/vkontakte.png",
    ],
];

const BUYERS_LINKS = [
    [
        "title"=> "Доставка и оплата",
        "url"=> "#",
    ],
    [
        "title"=> "Акции",
        "url"=> "#",
    ],
    [
        "title"=> "Бонусная програма",
        "url"=> "#",
    ],
    [
        "title"=> "Условия возврата",
        "url"=> "#",
    ],
];

const INFO_LINKS = [
    [
        "title"=> "Вопросы и ответы",
        "url"=> "#",
    ],
    [
        "title"=> "Новости",
        "url"=> "#",
    ],
    [
        "title"=> "Производители",
        "url"=> "#",
    ],
    [
        "title"=> "Контакты",
        "url"=> "#",
    ],
    [
        "title"=> "Сертификаты",
        "url"=> "#",
    ],
    [
        "title"=> "Политика конфиденциальности",
        "url"=> "#",
    ],
    [
        "title"=> "Карта сайта",
        "url"=> "#",
    ],
];
?>
<footer>
    <div class="footer__wrapper">
        <div class="footer__column">
            <h5>Категории</h5>
            <nav class="footer__links">
                <?php foreach (CATEGORIES as $category): ?>
                    <a href="<?= $category['link'] ?>"><?= $category['name'] ?></a>
                <?php endforeach; ?>
            </nav>
        </div>
        <div class="footer__column">
            <h5>Покупателям</h5>
            <nav class="footer__links">
                <?php foreach (BUYERS_LINKS as $link): ?>
                    <a href="<?= $link['url'] ?>"><?= $link['title'] ?></a>
                <?php endforeach; ?>
            </nav>
        </div>
        <div class="footer__column">
            <h5>Информация</h5>
            <nav class="footer__links">
                <?php foreach (INFO_LINKS as $link): ?>
                    <a href="<?= $link['url'] ?>"><?= $link['title'] ?></a>
                <?php endforeach; ?>
            </nav>
        </div>
        <div class="footer__column">
            <h3>8 (800) 555-35-35</h3>
            <h3>kotopes@mail.ru</h3>
            <div class="work-time">
                <span>Время работы:</span>
                <span>Пн-Пт: 9:00 - 22:00</span>
                <span>Сб-Вс: Выходной</span>
            </div>
            <nav class="social-links">
                <?php foreach (SOCIALS_LINKS as $link): ?>
                <a href="<?= $link['url'] ?>"><img src="<?= $link['src'] ?>" alt="<?= $link['title'] ?>" loading="lazy" /></a>
                <?php endforeach; ?>
            </nav>
        </div>
    </div>
</footer>
<?php if ($path === $serverPath . '/basket'): ?>
    <script src="<?= $sitePath ?>/scripts/jquery-3.7.1.min.js"></script>
    <script src="<?= $sitePath ?>/scripts/vue.global.js"></script>
    <script src="<?= $sitePath ?>/scripts/basket.js"></script>
<?php endif; ?>
<?php if ($path === $serverPath . ''): ?>
    <script src="<?= $sitePath ?>/scripts/swiper-bundle.min.js"></script>
    <script src="<?= $sitePath ?>/scripts/index.js"></script>
<?php endif; ?>

<?php if ($path === $serverPath . '/registration' || $path === $serverPath . '/login'): ?>
    <script src="https://www.google.com/recaptcha/api.js"></script>
<?php endif; ?>
    <script src="<?= $sitePath ?>/scripts/main.js"></script>
</body>
</html>