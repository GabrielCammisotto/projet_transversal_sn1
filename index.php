<?php include("header.php") ?>
    <main >
        <section class="index_title">
            <p class="kicker">The hangman game, reinvented</p>
            <h1 style="color: #F3EFE4;"class="title_page"><span style="color: #F2C14E">The</span > hangled game</h1>
            <p class="subtitle">Choose your difficulty and save the hangman.</p>
        </section>
        <div class="cards">
            <form action="./game.php" method="post" class="easy">
                <h2 style="color: #00fF00">difficulty made easy</h2>
                <p>Perfect to warm up:simple words and 2 letters
                     revealed from the start.</p>
                <input type="hidden" name="difficulty_id" value="1">
                <button type="submit" class="btn">play</button>
            </form>

            <form action="./game.php" method="post" class="medium" >
                <h2 style="color: #ffa600">difficulty made medium</h2>
                <p>A real challenge: trickier 
                    words and only 1 letter revealed from the start.</p>
                <input type="hidden" name="difficulty_id" value="1">
                <button type="submit" class="btn">play</button>
            </form>

            <form action="./game.php" method="post" class="hard">
                <h2 style="color: #ff0000">difficulty made hard</h2>
                <p>For experts only: the hardest 
                    words and no letters revealed. Good luck!</p>
                <input type="hidden" name="difficulty_id" value="1">
                <button type="submit" class="btn">play</button>
            </form>
        </div>
    </main>
</body>
</html>