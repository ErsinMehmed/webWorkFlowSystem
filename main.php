<!DOCTYPE html>
<html lang="bg">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="image/title.png">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/alert.css" />
    <script src="https://kit.fontawesome.com/d4b9f98a5c.js" crossorigin="anonymous"></script>
    <link href='https://fonts.googleapis.com/css?family=Dancing Script' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Carpet Cleaning</title>
</head>

<body>
    <!-- Бутона за връщане горе в страницата -->
    <button onclick="topFunction()" class="pop" id="scrollUp"><i class="fa-solid fa-angle-up fa-2xl"></i></button>
    <script>
        // Бутона за връщане най-горе в страницата.
        var mybutton = document.getElementById("scrollUp");
        window.onscroll = function() {
            scrollFunction()
        };

        //Бутона се появява след 710px по вертикала и се показва иначе се скрива
        function scrollFunction() {
            if (document.body.scrollTop > 710 || document.documentElement.scrollTop > 710) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
        }

        // Когато се цъкне на бутона се извършва долния код и те връща най-горе
        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>
    <!-- Тук започва навигационната лента -->
    <header id="nav">
        <a href="" class="logo"><img src="image/logo1.png" height="56px" alt=""></a>
        <ul class="navigation">
            <a href="">Начало</a>
            <a href="">Услуги</a>
            <a href="">За нас</a>
            <a href="">Контакти</a>
            <div title="Моят профил" class="circle" id="acc-modal-open"><i class="fa-solid fa-user fa-lg"></i></div>
            <div onclick="popup()" title=" Обадете ни се !" class="circle1"><i class="fa-solid fa-phone fa-lg "></i></div>
            <div class="menu-dot"></div>
            <span class="popuptext" id="phonePopup" title="Кликни за да копираш номера">+359 899 845 743</span>
            <a href="" class="GB-flag"><img src="image/Great_Britain_flag.png" alt=""></a>
        </ul>
        <!-- Това е кода за модалния прозорец, който се отваря за логин екрана -->
        <div id="acc-modal" class="acc-modal">
            <div class="acc-modal-content">
                <!-- Логин екрана -->
                <div class="container" id="container">
                    <div class="form-container sign-up-container">
                        <form id="userRegisterForm">
                            <h1>Регистрация</h1>
                            <div class="social-container">
                                <a href="#" class="social face-icon"><i class="fab fa-facebook-f c-white"></i></a>
                                <a href="#" class="social google-icon"><i class="fab fa-google-plus-g c-white"></i></a>
                                <a href="#" class="social twitter-icon"><i class="fa-brands fa-twitter c-white"></i></a>
                            </div>
                            <span>или използвайте вашият имейл за регистрация</span>
                            <i class="fa-solid fa-user u-i fa-sm"></i><input type="text" name="username" placeholder="Име" />
                            <i class="fa-solid fa-envelope e-i fa-sm"></i><input type="email" name="email" placeholder="Имейл" />
                            <i class="fa-solid fa-lock p-i fa-sm"></i><input id="reg_pass" type="password" name="password" placeholder="Парола" /><i class="fa-solid fa-eye show-img fa-lg"></i>
                            <i style="display: none;" class="fa-solid fa-eye-slash hide-img fa-lg"></i>
                            <button type="submit" class="btn-mar btn-hov">Регистрация</button>
                        </form>
                    </div>
                    <span class="acc_close">&times;</span>
                    <div class="form-container sign-in-container">
                        <form>
                            <h1>Вашият профил</h1>
                            <div class="social-container">
                                <a href="#" class="social face-icon"><i class="fab fa-facebook-f c-white"></i></a>
                                <a href="#" class="social google-icon"><i class="fab fa-google-plus-g c-white"></i></a>
                                <a href="#" class="social twitter-icon"><i class="fa-brands fa-twitter c-white"></i></a>
                            </div>
                            <span>или използвайте вашият акунт</span>
                            <i class="fa-solid fa-envelope e-i fa-sm"></i><input type="email" placeholder="Имейл" />
                            <i class="fa-solid fa-lock p-i fa-sm"></i><input id="reg_pass1" type="password" placeholder="Парола" /><i class="fa-solid fa-eye show-img1 fa-lg"></i>
                            <i style="display: none;" class="fa-solid fa-eye-slash hide-img1 fa-lg"></i>
                            <button id="forgot-pass" class="forgot">Забравена парола</button>
                            <button class="btn-hov">Вход</button>
                        </form>
                    </div>
                    <script>
                        //Показване и скриване на паролата на формата за регистрация
                        $(".show-img").click(function() {
                            $('#reg_pass').prop("type", "text");
                            $('.show-img').hide();
                            $('.hide-img').show();
                            $('#reg_pass').focus();
                        });

                        //Показване и скриване на паролата на формата за вход
                        $(".hide-img").click(function() {
                            $('#reg_pass').prop("type", "password");
                            $('.show-img').show();
                            $('.hide-img').hide();
                            $('#reg_pass').focus();
                        });

                        $(".show-img1").click(function() {
                            $('#reg_pass1').prop("type", "text");
                            $('.show-img1').hide();
                            $('.hide-img1').show();
                            $('#reg_pass1').focus();
                        });

                        $(".hide-img1").click(function() {
                            $('#reg_pass1').prop("type", "password");
                            $('.show-img1').show();
                            $('.hide-img1').hide();
                            $('#reg_pass1').focus();
                        });

                        //Показване на popup-а за забравена парола
                        $("#forgot-pass").click(function() {
                            $('.container').css("display", "none");
                            $('.for-pass').css("display", "block");
                        });
                    </script>
                    <div class="overlay-container">
                        <div class="overlay">
                            <div class="overlay-panel overlay-left">
                                <h1>Добре дошли!</h1>
                                <p>За да влезете във вашия профил изполвайте вашите данни</p>
                                <button class="ghost" id="signIn">Вход</button>
                            </div>
                            <span id="acc_close" class="acc_close">&times;</span>
                            <div class="overlay-panel overlay-right">
                                <h1>Здравейте!</h1>
                                <p>Регистрирайте се, защото с нас всичко е по-чисто и свежо</p>
                                <button class="ghost" id="signUp">Регистрация</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="for-pass">
                    <form action="#">
                        <h2>Забравена парола</h2>
                        <span>Ще изпратим имейл за задаване на нова парола на регистрирания Ваш имейл адрес</span>
                        <div><input required type="email" placeholder="Имейл" /></div>
                        <div><button id="back-main" class="forgot">Обранто към вход</button></div>
                        <button type="submit" class="btn-hov">Изпрати</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Тука свършва модала -->
    </header>
    <!-- Свърша навигацията -->

    <script>
        //Отваряне на процореца забравена парола и затваряне
        $("#back-main").click(function() {
            $('.for-pass').css("display", "none");
            $('.container').css("display", "block");
        });

        //сменянето на панелите на логин формата (наляво и надясно)
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        signUpButton.addEventListener('click', () => {
            container.classList.add("right-panel-active");
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove("right-panel-active");
        });

        //отварянето на модалния прозорец за логин прозореца и затварянето му
        var acc_modal = document.getElementById("acc-modal");
        var acc_btn = document.getElementById("acc-modal-open");
        var acc_span = document.getElementsByClassName("acc_close")[0];
        var aacc_span = document.getElementById("acc_close");

        acc_btn.onclick = function() {
            acc_modal.style.display = "block";
        }

        aacc_span.onclick = function() {
            acc_modal.style.display = "none";
        }

        acc_span.onclick = function() {
            acc_modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == acc_modal) {
                acc_modal.style.display = "none";
            }
        }

        // Отварянето и затварянето на popup-а за тел. номер в headr-a
        function popup() {
            const element = document.getElementById("phonePopup");
            element.classList.toggle("show");
        }

        // Копиране на телефонния номер от popup-a за тел. номер в header-а
        var copy = document.querySelector(".popuptext");
        var text = document.querySelector(".popuptext");

        copy.onclick = function() {
            navigator.clipboard.writeText(text.textContent);
        }

        // Скрол ефекта на навигационната лента
        window.addEventListener("scroll", function() {
            var header = document.getElementById("nav");
            header.classList.toggle("sticky", window.scrollY > 0);
        })
    </script>
    <!-- Тук започва големия слайдер със снимкатите и текста в горната част на страницата -->
    <div class="slideshow-container">
        <div class="mySlides " style="display: block;">
            <div class="text">
                <img class="stars" src="image/stars.png" alt="">
                <div class="companyName ">Carpet Cleaning</div>
                <h1 class="slideText ">Позволи ни да свършим</h1>
                <div class="slideText1 ">твоята мръсна работа</div>
            </div>
            <div class="text1 ">
                <button class="btn-slide1 ">Нашите услуги</button>
            </div>
            <img class="slideImg " src="image/slide1.jpg " style="width:100%">
        </div>

        <div class="mySlides " style="display: none; ">
            <div class="text3 ">
                <div class="welcome glow delay-1 ">Добре дошли в нашият сайт</div>
                <div class="slideText2 glow delay-2 ">Позволете ни да направим домът ви</div>
                <div class="slideText3 glow delay-2 ">Блестящ и Лъскъв</div>
                <div class="desc glow delay-3 ">Нашата експертна услуга за почистване на къщи и офиси придава на вашето място чист, професионален вид, който ще впечатли вашите гости. Професионалният ни персонал обръща внимание на детайлите</div>
                <button class="btn-slide2 glow delay-4 ">Нашите услуги</button>
            </div>
            <img class="slideImg " src="image/slide2.jpg " style="width:100% ">
        </div>

        <div class="mySlides " style="display: none; ">
            <div class="text3 ">
                <div class="welcome1 pop delay-1 ">Добре дошли в нашият сайт</div>
                <div class="slideText4 pop delay-2 ">Опитни професионалисти в</div>
                <div class="slideText5 pop delay-2 ">Услугите за Почистване</div>
                <div class="desc1 pop delay-3 ">Нашата експертна услуга за почистване на къщи и офиси придава на вашето място чист, професионален вид, който ще впечатли вашите гости. Професионалният ни персонал почиства с внимание към детайлите.</div>
                <button class="btn-slide3 pop delay-4 ">Нашите услуги</button>
            </div>
            <img class="slideImg " src="image/slide3.jpg " style="width:100% ">
        </div>

        <a class="prev " onclick="plusSlides(-1) ">❮</a>
        <a id="next " class="next " onclick="plusSlides(1) ">❯</a>
        <div class="dots">
            <span class="dot active" onclick="currentSlide(1) "><i class="fa-solid fa-droplet fa-xl"></i></span>
            <span class="dot" onclick="currentSlide(2) "><i class="fa-solid fa-droplet fa-xl"></i></span>
            <span class="dot" onclick="currentSlide(3) "><i class="fa-solid fa-droplet fa-xl"></i></span>
        </div>
    </div>
    <!-- Тука свършва слайдера -->
    <script>
        var slideIndex = 1;
        showSlides(slideIndex);

        var autoplayInterval = setInterval(function() {
            document.getElementById("next ").click();
        }, 11500); // числото е след какъв период от време да се сменят снимките в слайдера (в милисекунди)

        // тази функция взима индекса на самия слайд на снимката 1, 2 и 3
        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        // Показване на рекущи слайд
        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        // Самия слайдер
        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("dot ");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none ";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active ", " ");
            }

            slides[slideIndex - 1].style.display = "block ";
            dots[slideIndex - 1].className += " active ";
        }
    </script>
    <!-- Секцията с информация за работно време, телефон и локация -->
    <section>
        <div class="contacts">
            <div class="phone"><i class="fa-solid fa-phone fa-10x"></i></div>
            <div class="clock"><i class="fa-solid fa-clock fa-10x"></i></div>
            <div class="location"><i class="fa-solid fa-location-dot fa-10x"></i></div>
        </div>
        <div class="contacts1">
            <div class="row">
                <div class="phone1"><i class="fa-solid fa-phone fa-2x"></i></div>
                <div class="info">
                    <div class="info1">Имате въпроси ? Обадете ни се </div>
                    <div class="info2">+359 899 845 743</div>
                </div>
            </div>
            <div class="row">
                <div class="clock1"><i class="fa-solid fa-clock fa-2x"></i></div>
                <div class="info">
                    <div class="info1">Ние работим от <b>понеделник</b> - <b>петък</b></div>
                    <div class="info2">08:00 - 17:00</div>
                </div>
            </div>
            <div class="row">
                <div class="location1"><i class="fa-solid fa-location-dot fa-2x"></i></div>
                <div class="info">
                    <div class="info1">Нуждаете се от почистване ? Нашият адрес</div>
                    <div class="info2">Варна, ул. "Костадин Петков" 26</div>
                </div>
            </div>
        </div>
    </section>
    <script>
        // Когато скрола стигне до часста с горната информация да се пусне следната анимация
        const startAnimation = (entries, observer) => {
            entries.forEach(entry => {
                entry.target.classList.toggle("slide-in-from-right", entry.isIntersecting);
            });
        };

        const observer = new IntersectionObserver(startAnimation);
        const options = {
            root: null,
            rootMargin: '0px',
            threshold: 1
        };

        const elements = document.querySelectorAll('.info');
        elements.forEach(el => {
            observer.observe(el, options);
        });
    </script>
    <section class="white">
        <div class="row">
            <div class="left" data-aos="slide-right" data-aos-duration="2000">
                <img class="main-photo" src="image/8.jpg" alt="">
                <div class="img-circle"><img src="image/2-3.jpg" alt=""></div>
            </div>
            <div class="right" data-aos="slide-left" data-aos-duration="2000">
                <div class="head-text">Ние сме задължени да даваме само най-добрите услуги</div>
                <div class="text-box">
                    <div class="hour24">Нашият оперативен екип е 24 часа на разположение в денонощието ! Доверете ни се !</div>
                </div>
                <div class="text-desc">Екипите ни са обучени по приетите европейски изисквания за професионално почистване. Всеки един наш служител подхожда с голямо внимание към детайлите и дава максимума от своите възможности.</div>
                <div class="row">
                    <button id="modal-btn" class="contact-btn"><span>Обадете се</span></button>
                    <div class="tel">
                        <div class="estimate">Безплатна консултация</div>
                        <div class="tel-number">+359 899 845 743</div>
                    </div>
                </div>
            </div>
        </div>
        <div id="modal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <div class="row">
                    <img src="image/4-1.png" alt="">
                    <form name="sent" action="" method="post" class="fForm">
                        <div class="form-title" style="margin-top: 6px;">Оставете вашите данни.</div>
                        <div class="form-title" style="margin-bottom: 5px;">Ние ще се свържем с Вас !</div>
                        <label class="label-none" for="">Име и фамилия:</label>
                        <div class="form-group" id="input1">
                            <span id="border-span"><i class="fa-solid fa-user"></i></span>
                            <input id="name-input" required name="name" pattern="[a-zA-Z\u0400-\u04ff]{4,30}" class="form-field" type="text" placeholder="Вашето име">
                            <i id="done-sign" class="fa-solid fa-circle-check fa-lg"></i>
                            <i id="reject-sign" class="fa-solid fa-circle-exclamation fa-lg"></i>
                        </div>
                        <script>
                            //Проверките за модала 
                            $("#name-input").keypress(function() {
                                $("#border-span").css("background-color", "#5ca1e1");
                                $("#reject-sign").css("display", "none");
                                if ($(this).val().length > 2) {
                                    $("#name-input").css("border-color", "#AFE1AF");
                                    $("#border-span").css("border-color", "#AFE1AF").css("background-color", "#AFE1AF");
                                    $("#done-sign").css("display", "block");
                                }
                            });
                            $("#name-input").keydown(function() {
                                $("#name-input").css("border-color", "#CDD9ED");
                                $("#border-span").css("border-color", "#CDD9ED").css("background-color", "#EEF4FF");
                                $("#border-span").css("color", "white");
                            });

                            function check() {
                                const inpObj = document.getElementById("name-input");
                                const bord = document.getElementById("border-span");
                                const sign = document.getElementById("reject-sign");
                                const doneSign = document.getElementById("done-sign");
                                if (!inpObj.checkValidity()) {
                                    inpObj.style.borderColor = "#EE4B2B";
                                    bord.style.borderColor = "#EE4B2B";
                                    bord.style.background = "#EE4B2B";
                                    bord.style.color = "white";
                                    sign.style.display = "block";
                                    doneSign.style.display = "none";
                                }
                                const inpObj1 = document.getElementById("name-input1");
                                const bord1 = document.getElementById("border-span1");
                                const sign1 = document.getElementById("reject-sign1");
                                const doneSign1 = document.getElementById("done-sign1");
                                if (!inpObj1.checkValidity()) {
                                    inpObj1.style.borderColor = "#EE4B2B";
                                    bord1.style.borderColor = "#EE4B2B";
                                    bord1.style.background = "#EE4B2B";
                                    bord1.style.color = "white";
                                    sign1.style.display = "block";
                                    doneSign1.style.display = "none";
                                }
                                if (!inpObj.checkValidity()) {

                                }
                            }
                        </script>
                        <label class="label-none" for="">Телефонен номер:</label>
                        <div class="form-group" id="input2">
                            <span id="border-span1"><i class="fa-solid fa-phone"></i></span>
                            <input id="name-input1" pattern="^[0-9]\S+$" onkeypress="return event.charCode != 32" required maxlength="10" name="phone" class="form-field" type="text" placeholder="Вашият тел. номер">
                            <i id="done-sign1" class="fa-solid fa-circle-check fa-lg"></i>
                            <i id="reject-sign1" class="fa-solid fa-circle-exclamation fa-lg"></i>
                        </div>
                        <script>
                            $("#name-input1").keypress(function() {
                                $("#border-span1").css("background-color", "#5ca1e1");
                                $("#reject-sign1").css("display", "none");
                                if ($(this).val().length >= 9) {
                                    $("#name-input1").css("border-color", "#AFE1AF");
                                    $("#border-span1").css("border-color", "#AFE1AF").css("background-color", "#AFE1AF");
                                    $("#done-sign1").css("display", "block");
                                }
                            });
                            $("#name-input1").keydown(function() {
                                $("#name-input1").css("border-color", "#CDD9ED");
                                $("#border-span1").css("border-color", "#CDD9ED").css("background-color", "#EEF4FF");
                                $("#border-span1").css("color", "white");
                            });
                        </script>
                        <button onclick="check()" type="submit" class="sub-btn">Изпрати</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
        var modal = document.getElementById("modal");

        var btn = document.getElementById("modal-btn");

        var span = document.getElementsByClassName("close")[0];

        btn.onclick = function() {
            modal.style.display = "block";
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
    <section class="par-sec">
        <div class="parallax"></div>
        <div data-aos="slide-down" data-aos-duration="1500">
            <div class="important">Всеки детайл е важен</div>
            <div class="line-element"></div>
            <div class="pre">Приоритизираме следното</div>

            <div class="tab">
                <button class="tablinks" onclick="openTab(event, 'fTab')">
                    <div>
                        <i class="fa-solid fa-people-group fa-4x"></i>
                        <div class="tab-text">нашите клиенти</div>
                    </div>
                </button>
                <button class="tablinks actives" onclick="openTab(event, 'sTab')">
                    <div>
                        <i class="fa-solid fa-hand-sparkles fa-4x"></i>
                        <div class="tab-text">процес</div>
                    </div>
                </button>
                <button class="tablinks" onclick="openTab(event, 'tTab')">
                    <div>
                        <i class="fa-regular fa-comments fa-4x"></i>
                        <div class="tab-text">комуникация</div>
                    </div>
                </button>
            </div>

            <div id="fTab" class="tabcontent">
                <p>Нашите услуги за почистване са достъпни и нашите експерти по почистване са високо обучени. Ако по някаква причина не сте доволни от нашите професионални почистващи услуги, свържете се с нас. Ще се върнем и ще почистим конкретните зони,
                    които не отговарят на вашите очаквания. Нищо не е по-важно за нас от вашето удовлетворение.</p>
            </div>

            <div id="sTab" class="tabcontent block">
                <p>Нашият непрекъснат стремеж към съвършенство води до постоянен растеж всяка година. Нашият фокус е да изслушваме нашите клиенти, да разбираме техните нужди и да предоставяме изключително ниво на услуги за почистване на жилищни и търговски
                    сгради. Изберете нас заради нашата отлична репутация.</p>
            </div>

            <div id="tTab" class="tabcontent">
                <p>Ако по някаква причина не сте доволни от нашите услуги за почистване, моля свържете се с нас. Ще се върнем и ще почистим конкретните зони, които не отговарят. В случай, че имате нужда от специална почистваща услуга, ние ще се радваме да
                    изпълним всяка заявка, за да надминем вашите очаквания.</p>
            </div>
        </div>
        </div>
        <script>
            function openTab(evt, tabName) {
                var i, tabcontent, tablinks;
                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("tablinks");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" actives", "");
                }
                document.getElementById(tabName).style.display = "block";
                evt.currentTarget.className += " actives";
            }
        </script>
    </section>
    <section>
        <div class="back-opacity"></div>
        <div class="vol-line"></div>
        <div class="workprocess">
            <div data-aos="slide-down" data-aos-duration="1500">
                <div class="process">работен процес</div>
                <div class="how-work">Как работим ние</div>
                <div class="work-line"></div>
            </div>
            <img class="line-img" src="image/workprocess.png" alt="" data-aos="slide-down" data-aos-duration="900">
            <div class="margin-group">
                <div class="img-group">
                    <div class="first-group" data-aos="slide-right" data-aos-duration="1850">
                        <div class="heximg"><img class="" src="image/12.jpg" alt=""></div>
                        <div class="hexagon"><span class="num">01</span></div>
                        <div class="hex-text">Поръчай Онлайн</div>
                    </div>
                    <div class="second-group" data-aos="slide-down" data-aos-duration="1850">
                        <img src="image/14.jpg" alt="">
                        <div class="second-hexagon"><span class="num"></span>02</span>
                        </div>
                        <div class="hex-text" style="margin-top: 30px;">Получи Експертно Почистване</div>
                    </div>
                    <div class="third-group" data-aos="slide-left" data-aos-duration="1850">
                        <div class="heximg"><img src="image/13.jpg" alt=""></div>
                        <div class="hexagon"><span class="num"></span>03</span>
                        </div>
                        <div class="hex-text">Релакс & Наслада</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="img-section">
        <div class="img-flex" data-aos="slide-right" data-aos-duration="1100">
            <img class="modal-img" src="image/Depositphotos_9304975_original-1536x1024.jpg" alt="">
            <img class="modal-img" src="image/Depositphotos_10747592_original-1170x780.jpg" alt="">
            <img class="modal-img" src="image/Depositphotos_28062927_original.jpg" alt="">
            <img class="modal-img" src="image/Depositphotos_35453565_original.jpg" alt="">
        </div>
        <div class="img-flex" data-aos="slide-left" data-aos-duration="1100">
            <img class="modal-img" src="image/Depositphotos_39414465_original-1170x780.jpg" alt="">
            <img class="modal-img" src="image/Depositphotos_51407121_original.jpg" alt="">
            <img class="modal-img" src="image/Depositphotos_88779358_original-1536x1025.jpg" alt="">
            <img class="modal-img" src="image/Depositphotos_89551394_original-1536x1025.jpg" alt="">
        </div>
    </div>
    <div class="modall">
        <span class="closes">×</span>
        <img class="modalImage" id="img01" />
    </div>
    <script>
        var modalEle = document.querySelector(".modall");
        var modalImage = document.querySelector(".modalImage");
        Array.from(document.querySelectorAll(".modal-img")).forEach(item => {
            item.addEventListener("click", event => {
                modalEle.style.display = "block";
                modalImage.src = event.target.src;
            });
        });
        document.querySelector(".closes").addEventListener("click", () => {
            modalEle.style.display = "none";
        });
        document.querySelector(".modall").addEventListener("click", () => {
            modalEle.style.display = "none";
        });
    </script>
    <section class="about">
        <div class="left-side" data-aos="slide-right" data-aos-duration="1800">
            <div class="rate">Първи според мнението на клиентите</div>
            <div class="about-head">Имате проблем, свързан с почистването?</div>
            <div class="about-text">Не се притеснявайте да се свържите с нас! Ние предлагаме много голям асортимент от професионални почистващи услуги. Клиентите ни нареждат на първо място по качество и бързина на предоставента услуга! Изберете нас за да можем да направим домът
                Ви удобен и уютен.</div>
            <div class="about-text ">Носители на наградата "Excelent cleaning servises " за 2023 г. Ние сме първите на локалния пазар, които предоставиха пълен пакет за почистване!</div>
            <button class="about-button"><a href=" ">Нашите услуги</a></button>
        </div>
        <div class="right-side"><img src="image/about-2-434x410.png" alt=" "></div>
    </section>
    <section>
        <div data-aos="slide-down" data-aos-duration="1800">
            <div class="serv-head">Предлагаме високачествени услуги</div>
            <div class="serv-head2">На достъпни цени</div>
            <div class="work-linee"></div>
        </div>
        <div class="col-flex">
            <div class="left-col" data-aos="slide-right" data-aos-duration="1800">
                <div class="serv-box">
                    <img class="mar-top1" src="image/icon-5.png" alt="">
                    <div class="box-head">Почистване на домове</div>
                    <div class="box-text">Поддържаме дома Ви блестящо чист и без микроби. Нашият процес на дезинфекция убива 99% от често срещаните бактерии и вируси.</div>
                </div>
                <div class="serv-box">
                    <img class="mar-top" src="image/icon-7.png" alt="">
                    <div class="box-head">Цялостно пране</div>
                    <div class="box-text">Почистване и пране на мека мебел и мебели. Грижим се всяко кътче от домът ви да е изящен и блестящ, отговарящо на нашите стандарти.</div>
                </div>
            </div>
            <div class="mid-col" data-aos="slide-up" data-aos-duration="1800">
                <img src="image/image_03-1-600x600.jpg" alt="">
            </div>
            <div class="right-col" data-aos="slide-left" data-aos-duration="1800">
                <div class="serv-box1">
                    <img class="mar-top1" src="image/icon-8.png" alt="">
                    <div class="box-head">Почистване на офиси</div>
                    <div class="box-text1">Поддържаме офиса Ви блестящо чист и без микроби. Нашият процес на дезинфекция убива 99% от често срещаните бактерии и вируси.</div>
                </div>
                <div class="serv-box1">
                    <img class="mar-top" src="image/icon-9.png" alt="">
                    <div class="box-head">Почистване на прозорци</div>
                    <div class="box-text1">Нашите екипи прилагат професионални съвременни методи за почистване на прозорци. Нашите препарати поддържат прозорците чисти по-дълго.</div>
                </div>
            </div>
        </div>
        <div class="but-div"><button class="serv-button"><a href=" ">Вижте повече</a></button></div>
    </section>
    <section>
        <div class="price-body">
            <div class="price-head">Разгледайте нашите оферти и направете подходящият избор за Вас</div>
            <div class="price-line"></div>
            <div class="price-info">Carpet Cleaning предоставя калкулатор на разходите – уникален инструмент, който Ви позволява лесно да пресметнете и оцените нашите цени. Направете сами преценка коя оферта е подходяща за Вас!</div>
            <div class="calcultor-body">
                <div class="flex-row">
                    <div class="range-box">
                        <div class="range-head">Oбща площ за почистване в квадратни метра:</div>
                        <input id="slider" class="range-slider" type="range" value="1000" min="0" max="2000"> <input id="final" type="text" value="1000">
                    </div>
                    <div class="select-box">
                        <div class="range-head1">Изберете вид на помещение: <span id="sel-logo"><i class="fa-solid fa-house g"></i></span>
                        </div>
                        <select name="" id="select-buil">
                            <option value="0">Къща</option>
                            <option value="1">Офис</option>
                            <option value="2">Салон</option>
                        </select>
                    </div>
                </div>
                <div class="flex-row">
                    <div class="price-box b-1">
                        <h3>Основна оферта</h3>
                        <span id="slider_value" class="val">150.00 <span>лв.</span></span>
                        <div class="one-time">Еднократна услуга</div>
                        <div class="al">
                            <div class="odd">Основно почистване <i style="margin-left: 57px;" class="fa-solid fa-check g"></i></div>
                            <div class="even">Пофесионални препарати <i class="fa-solid fa-check g"></i></div>
                            <div class="odd">Цялостно почистване <i style="margin-left: 51.4px;" class="fa-solid fa-xmark r"></i></div>
                            <div class="even">Почистване на прозорци <i style="margin-left: 27px;" class="fa-solid fa-check g"></i></div>
                            <div class="odd">Почистване на общи части <i style="margin-left: 12.4px;" class="fa-solid fa-xmark r"></i></div>
                            <div class="even">Пръскане за вредители <i style="margin-left: 37.4px;" class="fa-solid fa-xmark r"></i></div>
                            <div class="odd">Ароматизиране <i style="margin-left: 96.4px;" class="fa-solid fa-xmark r"></i></div>
                            <button class="make-order"><a href="">Направи поръчка</a></button>
                        </div>
                    </div>
                    <div class="price-box b-2">
                        <h3>Премиум оферта</h3>
                        <span id="slider_value1" class="val">220.00 <span>лв.</span></span>
                        <div class="one-time">Еднократна услуга</div>
                        <div class="al">
                            <div class="odd">Основно почистване <i style="margin-left: 57px;" class="fa-solid fa-check g"></i></div>
                            <div class="even">Пофесионални препарати <i class="fa-solid fa-check g"></i></div>
                            <div class="odd">Цялостно почистване <i style="margin-left: 49px;" class="fa-solid fa-check g"></i></div>
                            <div class="even">Почистване на прозорци <i style="margin-left: 27px;" class="fa-solid fa-check g"></i></div>
                            <div class="odd">Почистване на общи части <i style="margin-left: 12.4px;" class="fa-solid fa-xmark r"></i></div>
                            <div class="even">Пръскане за вредители <i style="margin-left: 35px;" class="fa-solid fa-check g"></i></div>
                            <div class="odd">Ароматизиране <i style="margin-left: 96.4px;" class="fa-solid fa-xmark r"></i></div>
                            <button class="make-order"><a href="">Направи поръчка</a></button>
                        </div>
                    </div>
                    <div class="price-box b-3">
                        <h3>Вип оферта</h3>
                        <span id="slider_value2" class="val">270.00 <span>лв.</span></span>
                        <div class="one-time">Еднократна услуга</div>
                        <div class="al">
                            <div class="odd">Основно почистване <i style="margin-left: 57px;" class="fa-solid fa-check g"></i></div>
                            <div class="even">Пофесионални препарати <i class="fa-solid fa-check g"></i></div>
                            <div class="odd">Цялостно почистване <i style="margin-left: 49px;" class="fa-solid fa-check g"></i></div>
                            <div class="even">Почистване на прозорци <i style="margin-left: 27px;" class="fa-solid fa-check g"></i></div>
                            <div class="odd">Почистване на общи части <i style="margin-left: 10px;" class="fa-solid fa-check g"></i></div>
                            <div class="even">Пръскане за вредители <i style="margin-left: 35px;" class="fa-solid fa-check g"></i></div>
                            <div class="odd">Ароматизиране <i style="margin-left: 94px;" class="fa-solid fa-check g"></i></div>
                            <button class="make-order"><a href="">Направи поръчка</a></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $('#select-buil').on('change', function() {
            var x = document.getElementById("select-buil").selectedIndex;
            var n = $('#slider').val();

            if (x == 0) {
                var value = (n * 0.12) + 30;
                var value1 = (n * 0.14) + 60;
                var value2 = (n * 0.16) + 90;

                var result = parseFloat(value).toFixed(2);
                var result1 = parseFloat(value1).toFixed(2);
                var result2 = parseFloat(value2).toFixed(2);

                $('#slider_value').html(result + " лв.");
                $('#slider_value1').html(result1 + " лв.");
                $('#slider_value2').html(result2 + " лв.");
                $('#final').val(n);

                $('#sel-logo').html('<i class="fa-solid fa-house g"></i>');
            }

            if (x == 1) {
                var value = (n * 0.18) + 30;
                var value1 = (n * 0.2) + 60;
                var value2 = (n * 0.22) + 90;

                var result = parseFloat(value).toFixed(2);
                var result1 = parseFloat(value1).toFixed(2);
                var result2 = parseFloat(value2).toFixed(2);

                $('#slider_value').html(result + " лв.");
                $('#slider_value1').html(result1 + " лв.");
                $('#slider_value2').html(result2 + " лв.");
                $('#final').val(n);

                $('#sel-logo').html('<i class="fa-solid fa-building g"></i>');
            }

            if (x == 2) {
                var value = (n * 0.24) + 30;
                var value1 = (n * 0.26) + 60;
                var value2 = (n * 0.28) + 90;

                var result = parseFloat(value).toFixed(2);
                var result1 = parseFloat(value1).toFixed(2);
                var result2 = parseFloat(value2).toFixed(2);

                $('#slider_value').html(result + " лв.");
                $('#slider_value1').html(result1 + " лв.");
                $('#slider_value2').html(result2 + " лв.");
                $('#final').val(n);

                $('#sel-logo').html('<i class="fa-solid fa-dungeon g"></i>');
            }
        });

        $(document).on('input', '#slider', function() {

            var x = document.getElementById("select-buil").selectedIndex;
            var n = $('#slider').val();

            if (x == 0) {
                var value = (n * 0.12) + 30;
                var value1 = (n * 0.14) + 60;
                var value2 = (n * 0.16) + 90;

                var result = parseFloat(value).toFixed(2);
                var result1 = parseFloat(value1).toFixed(2);
                var result2 = parseFloat(value2).toFixed(2);

                $('#slider_value').html(result + " лв.");
                $('#slider_value1').html(result1 + " лв.");
                $('#slider_value2').html(result2 + " лв.");
                $('#final').val(n);
            }

            if (x == 1) {
                var value = (n * 0.18) + 30;
                var value1 = (n * 0.2) + 60;
                var value2 = (n * 0.22) + 90;

                var result = parseFloat(value).toFixed(2);
                var result1 = parseFloat(value1).toFixed(2);
                var result2 = parseFloat(value2).toFixed(2);

                $('#slider_value').html(result + " лв.");
                $('#slider_value1').html(result1 + " лв.");
                $('#slider_value2').html(result2 + " лв.");
                $('#final').val(n);
            }

            if (x == 2) {
                var value = (n * 0.24) + 30;
                var value1 = (n * 0.26) + 60;
                var value2 = (n * 0.26) + 90;

                var result = parseFloat(value).toFixed(2);
                var result1 = parseFloat(value1).toFixed(2);
                var result2 = parseFloat(value2).toFixed(2);

                $('#slider_value').html(result + " лв.");
                $('#slider_value1').html(result1 + " лв.");
                $('#slider_value2').html(result2 + " лв.");
                $('#final').val(n);
            }
        });

        $(document).on('input', '#final', function() {

            var final = $('#final').val();
            $('#slider').val(final);

            if (final == "") {
                $('#slider').val(0);
            }
            if (final > 2000) {
                var final = $('#final').val(2000);
            }

            var x = document.getElementById("select-buil").selectedIndex;
            var n = $('#final').val();

            if (x == 0) {
                var value = (n * 0.12) + 30;
                var value1 = (n * 0.14) + 60;
                var value2 = (n * 0.16) + 90;

                var result = parseFloat(value).toFixed(2);
                var result1 = parseFloat(value1).toFixed(2);
                var result2 = parseFloat(value2).toFixed(2);

                $('#slider_value').html(result + " лв.");
                $('#slider_value1').html(result1 + " лв.");
                $('#slider_value2').html(result2 + " лв.");
                $('#final').val(n);
            }

            if (x == 1) {
                var value = (n * 0.18) + 30;
                var value1 = (n * 0.2) + 60;
                var value2 = (n * 0.22) + 90;

                var result = parseFloat(value).toFixed(2);
                var result1 = parseFloat(value1).toFixed(2);
                var result2 = parseFloat(value2).toFixed(2);

                $('#slider_value').html(result + " лв.");
                $('#slider_value1').html(result1 + " лв.");
                $('#slider_value2').html(result2 + " лв.");
                $('#final').val(n);
            }

            if (x == 2) {
                var value = (n * 0.24) + 30;
                var value1 = (n * 0.26) + 60;
                var value2 = (n * 0.26) + 90;

                var result = parseFloat(value).toFixed(2);
                var result1 = parseFloat(value1).toFixed(2);
                var result2 = parseFloat(value2).toFixed(2);

                $('#slider_value').html(result + " лв.");
                $('#slider_value1').html(result1 + " лв.");
                $('#slider_value2').html(result2 + " лв.");
                $('#final').val(n);
            }
        });
    </script>
    <section>
        <div class="parallax1"></div>
        <div class="color">
            <div class="dis-flex">
                <div class="s-box cen">
                    <img src="image/icon-11.png" alt="">
                    <div class="num-serv">2000</div>
                    <div class="num-text">Завършени поръчки</div>
                </div>
                <div class="left-bor"></div>
                <div class="s-box cen">
                    <img src="image/icon-12.png" style="margin-top: 11px;" alt="">
                    <div class="num-serv" style="margin-top: 4px;">800</div>
                    <div class="num-text">Щастливи клиенти</div>
                </div>
                <div class="left-bor"></div>
                <div class="s-box cen">
                    <img src="image/icon-13.png" alt="">
                    <div class="num-serv">5</div>
                    <div class="num-text">Гонини опит</div>
                </div>
                <div class="left-bor"></div>
                <div class="s-box cen">
                    <img src="image/icon-14.png" alt="">
                    <div class="num-serv">20</div>
                    <div class="num-text">Брой служители</div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="clients-body">
            <div data-aos="slide-up" data-aos-duration="1700">
                <div class="our-clients">нашите клиенти</div>
                <div class="client-head">Какво казват клиентите <b>за нас</b></div>
                <div class="opinion">Мнението на клиентите е изграждаща единица в развитието на всяка компания. Ето защо мнението на нашите клиенти е важно за нас за поддържаме нашата репутация на високо ниво! Благодарим, че избрахте нас!</div>
                <div class="op-box-flex">
                    <div class="ro1">
                        <div class="op-box">
                            "За нас е много важно винаги да предоставяме само еднотипни висококачествени услуги и продукти на нашите клиенти"
                        </div>
                        <img src="image/testimonials-1.png" alt="">
                        <div class="name">Филип Иванов</div>
                        <div class="pos">SEO специалист</div>
                    </div>
                    <div class="ro2">
                        <div class="op-box">
                            "Най-добрата реклама е добре свършената работа. Това ни мотивира да даваме 100% от себе си"
                        </div>
                        <img src="image/testimonials-2.png" alt="">
                        <div class="name">Костадин Тодоров</div>
                        <div class="pos">Маркетинг специалист</div>
                    </div>
                    <div class="ro3">
                        <div class="op-box">
                            "Успеха за всяка фирма идва от добре свършената работа и най-вече от доволните клиенти"
                        </div>
                        <img src="image/testimonials-3.png" alt="">
                        <div class="name">Виктория Маркова</div>
                        <div class="pos">Директор</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <div class="foot-cont">
            <div class="cont-head">Контакти</div>
            <div class="foot-line"></div>
            <div class="loc"><span><i class="fa-solid fa-location-dot fmar"></i></span> Варна, ул. "Костадин Петков" 26</div>
            <div class="email"><i class="fa-solid fa-envelope smar"></i> carpetserv@gmail.com</div>
            <div class="foot-phone"><i class="fa-solid fa-phone tmar"></i> +359 899 845 743</div>
        </div>
        <div class="foot-nav">
            <div class="cont-head">Работно време</div>
            <div class="foot-line s-line"></div>
            <div class="open-h">09:00 - 17:00 <span class="f-span">Пон - Сря</span></div>
            <div class="open-h hour-mar">09:00 - 17:00 <span class="f-span">Чет - Пет</span></div>
            <div class="open-h">Затворено <span class="s-span">Съб - Нед</span></div>
        </div>
        <div class="soc-nav">
            <div class="cont-head">Социални мрежи</div>
            <div class="foot-line t-line"></div>
            <a href="">
                <div class="soc-icon"><i class="fa-brands fa-facebook-f face-color fa-lg soc-mar"></i> Facebook</div>
            </a>
            <a href="">
                <div class="soc-icon"><i class="fa-brands fa-instagram insta-color soc-mar1"></i> Instagram</div>
            </a>
            <a href="">
                <div class="soc-icon"><i class="fa-brands fa-youtube youtube-color fa-lg soc-mar2"></i> You Tube</div>
            </a>
        </div>
        <div class="newsletter">
            <div class="cont-head">Бюлетин</div>
            <div class="foot-line"></div>
            <form action="" method="post">
                <div><input class="news-input" required type="email" placeholder="Въведете имейл"><span><button type="submit" class="paper-plane"><i class="fa-solid fa-paper-plane"></i></button></span></div>
                <div class="news-text">Абонирайте се за нашия бюлетин за да сте актуални!</div>
            </form>
        </div>
    </footer>
    <div class="copy-write">© 2021 Създадено от <span>Ерсо</span></div>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="main/main.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>