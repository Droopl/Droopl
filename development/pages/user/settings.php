<article class="settings">
    <div class="feed">
        <section class="settings-container">
            <aside class="left">
                <form id="upload-profile-img">
                    <header id="upload">
                        <div class="dragndrop" id="dragndrop">
                            <div class="preloader">
                                <span class="remove-file"><p class="icon-cross"></p></span>
                                <input type="file" id="collection_image" name="collection_image" accept="image/*">
                            </div>
                        </div>
                        <h1>Drag and drop</h1>
                        <p>Or press to browse</p>
                    </header>
                </form>
            </aside>
            <aside class="right">
                <h1 class="settings-title">Account Settings</h1>
                <label for="first">Firstname:</label>
                <input type="text" id="first" name="first" value="<?php echo $user['firstname']; ?>">
                <label for="last">Last name:</label>
                <input type="text" id="last" name="last" value="<?php echo $user['lastname']; ?>">
                <label for="new_pass">New password:</label>
                <input type="password" id="new_pass" name="new_pass" placeholder="">
                <label for="repeat_new_pass">Repeat password:</label>
                <input type="password" id="repeat_new_pass" name="repeat_new_pass" placeholder="">
                <div class="select-language">
                                <h1>Language: </h1>
                                <div class="flag <?php echo $user['lang'] ?>"></div>
                                <ul class="lang-list">
                                    <li class="en"><span class="en-flag"></span>English</li>
                                    <li class="nl"><span class="nl-flag"></span>Nederlands</li>
                                    <li class="fr"><span class="fr-flag"></span>Français</li>
                                </ul>
                                <input class="hide" type="text" id="selected_lang" name="selected-lang" value="en">
                </div>
                
            </aside>
        </section>
    </div>
</article>