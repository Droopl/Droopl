<article class="register">
    
    <div class="register-box animated fadeInUp">
        
        <div class="container">
        
            <section class="step_1 completed">
                <aside class="left">
                    <h1 class="title">Registration</h1>
                    <form id="registration_form_step_1" method="post">
                        <input type="text" id="first" name="first" placeholder="Firstname" required>
                        <input type="text" id="last" name="last" placeholder="Last name" required>
                        <input type="email" id="mail" name="mail" placeholder="Email" required>
                        <input type="password" id="pass" name="pass" placeholder="Password" required>
                        <input type="password" id="repeat_pass" name="repeat_pass" placeholder="Repeat password" required>
                        
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
                        <input type="submit" id="submit_step_1" name="submit_step_1" value="Step 2">
                    </form>
                </aside>
                <aside class="right">
                    <img src="images/assets/droopl_logo.svg">
                </aside>
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
                        <p class="resulting-address">Address:</p>
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
                    step3
                </aside>
                <aside class="right">
                </aside>
            </section>
            <section class="step_4">
                <aside class="left">
                    step4
                </aside>
                <aside class="right">
                </aside>
            </section>
        
        </div>
        
        <nav class="pages">
            <ul>
                <li class="current"></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </nav>
        
    </div>
    
</article>