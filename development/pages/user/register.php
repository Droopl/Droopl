<article class="register">

    <div class="register-box animated fadeInUp">

        <div class="container">

            <section class="step_1">
                <form action="" id="registration_form_step_1" method="post" enctype="multipart/form-data">
                    <aside class="left">
                        <h1 class="title">Registration</h1>
                            <input type="text" id="first" name="first" placeholder="First name">
                            <input type="text" id="last" name="last" placeholder="Last name">
                            <input type="email" id="mail" name="mail" placeholder="Email">
                            <input type="password" id="pass" name="pass" placeholder="Password">
                            <input type="password" id="repeat_pass" name="repeat_pass" placeholder="Repeat password">
                            <input type="text" id="birth_date" name="birth_date" onfocus="(this.type='date')" placeholder="Date of birth">
                            <div class="select-language">
                                <h1>Language: </h1>
                                <div class="flag en"></div>
                                <ul class="lang-list">
                                    <li class="en"><span class="en-flag"></span>English</li>
                                    <li class="nl"><span class="nl-flag"></span>Nederlands</li>
                                    <li class="fr"><span class="fr-flag"></span>Français</li>
                                </ul>
                                <input class="hide" type="text" id="selected_lang" name="selected-lang" value="en">
                            </div>
                    </aside>
                    <aside class="right">
                            <header id="upload">
                                <h1 >Profile picture</h1>
                                <div class="dragndrop" id="dragndrop">
                                    <div class="preloader">
                                        <span class="remove-file"><p class="icon-cross hide"></p></span>
                                        <input type="file" id="profile_image" name="profile_image" accept="image/*">
                                    </div>
                                </div>
                                <h2>Drag and drop</h2>
                                <p>Or press to browse</p>
                            </header>
                            <div class="switch-gender">
                                <div class="switch-container">
                                    <p class="male selected">Male</p>
                                    <div class="switch-limit"  id="register_switch_btn">
                                        <div class="switch-btn male"></div>
                                    </div>
                                    <p class="female">Female</p>
                                </div>
                            </div>
                            <input class="hide" type="text" id="gender" name="gender" value="m">
                            <div class="voorwaarden">

                                <p><input type="checkbox" id="agreed" name="agreed" value="1"> I agree to the <a href="terms/terms-nl.pdf" target"_blank">terms and conditions</a></p>
                            </div>
                    </aside>
                    <input type="submit" id="submit_step_1" name="submit_step_1" value="Step 2">
                </form>
            </section>
            <section class="step_2">
                <aside class="left">
                    <form id="search_location_form" method="post">
                        <input class="controls" type="text" id="search_location" name="search_location" placeholder="Search location ..." required>
                        <input type="button" id="find_me_btn" name="find_me_btn">
                        <div class="loader-container">
                            <p class="location-loader">Locating</p>
                        </div>
                        <div id="maps-api-container">
                        </div>
                        <input class="hide" type="text" id="street" name="street" value="">
                        <input class="hide" type="text" id="number" name="number" value="">
                        <input class="hide" type="text" id="zipcode" name="zipcode" value="">
                        <input class="hide" type="text" id="city" name="city" value="">
                        <input class="hide" type="text" id="country" name="country" value="">
                        <input class="hide" type="text" id="latitude" name="latitude" value="">
                        <input class="hide" type="text" id="longitude" name="longitude" value="">
                        <input type="submit" id="submit_step_2" name="submit_step_2" value="Step 3">
                    </form>
                </aside>
            </section>

            <section class="step_3">
                <aside class="left">
                    <form action="?page=feed" id="validation_form" method="get">
                        <h1>Thank you for creating an account</h1>
                        <p>Droopl works best when people are active on the website, don’t forget to invite your friends and family .</p>
                        <span class="icon-check"></span>
                        <!--<ul class="code-ul">
                            <li>
                                <input type="text" id="digit_1" name="digit_1" maxlength="1" required>
                            </li>
                            <li>
                                <input type="text" id="digit_2" name="digit_2" maxlength="1" required>
                            </li>
                            <li>
                                <input type="text" id="digit_3" name="digit_3" maxlength="1" required>
                            </li>
                            <li>
                                <input type="text" id="digit_4" name="digit_4" maxlength="1" required>
                            </li>
                        </ul>-->
                        <input type="submit" id="submit_step_3" name="submit_step_3" value="Explore Droopl">
                    </form>
                </aside>
            </section>

        </div>

        <nav class="pages">
            <ul>
                <li class="current"></li>
                <li></li>
            </ul>
        </nav>

    </div>

</article>
