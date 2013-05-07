<?php $this->getHeader(); ?>

        <div id="content">
            <div id ="poll">
                <h1 class="title" >Titre de l'évènement</h1>
                <p class="small_title" >Par Prénom NOM</p>
                <p class="text" >Description de l'évènement</p><?php echo uniqid(); ?>
                <div id="poll_choices">
                    <table>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td class="text" >Proposition</td>
                            <td class="text" ><div>coucou</div>Machin a voté et <a class="link" >5 autres personnes</a></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td class="text" >Proposition</td>
                            <td class="text" ><div>coucou</div>Machin a voté</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td class="text" >Proposition</td>
                            <td class="text" ><div>coucou</div>Machin a voté</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td class="text" >Proposition</td>
                            <td class="text" ><div>coucou</div>Machin a voté</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td class="text" >Proposition</td>
                            <td class="text" ><div>coucou</div>Machin a voté</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td class="text" >Proposition</td>
                            <td class="text" ><div>coucou</div>Machin a voté</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td class="text" >Proposition</td>
                            <td class="text" ><div>coucou</div>Machin a voté</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td class="text" >Proposition</td>
                            <td class="text" ><div>coucou</div>Machin a voté</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td class="text" >Proposition</td>
                            <td class="text" ><div>coucou</div>Machin a voté</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td class="text" >Proposition</td>
                            <td class="text" ><div>coucou</div>Machin a voté</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td class="text" >Proposition</td>
                            <td class="text" ><div>coucou</div>Machin a voté</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td class="text" >Proposition</td>
                            <td class="text" ><div>coucou</div>Machin a voté</td>
                        </tr>
                    </table>
                </div>
                <input type="text" class="small_text_edit" placeholder="Prénom Nom" >
                <input type="button" class="orange_small_button" value="Voter" >
            </div>
        </div>
        
<?php $this->getFooter(); ?>