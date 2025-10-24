<?php 

function sidebar()

{
    ?>
    <div class="open" id="open" onclick="openSide()">
        <span class="material-symbols-outlined">
            first_page
        </span>
    </div>
    <aside id="sidebar">
        <div class="user">
            <div class="userinfo">
                <img src="./assets/imgs/user.jpg"
                    alt="User image">
                <p class="username"><?= $_SESSION['username'] ?></p>
            </div>
            <div class="close" onclick="closeSide()">
                <span class="material-symbols-outlined">
                    first_page
                </span>
            </div>
        </div>
        <div class="asideNav">
            <a class="link" href="./add.php">
                <i class="fa-solid fa-plus"></i>
                <p class="textLink">Adicionar Tarefa</p>
            </a>
            <a class="link" href="./index.php">
                <i class="fa-solid fa-list-check"></i>
                <p class="textLink">A fazer</p>
            </a>
            <a class="link" href="./ending.php">
                <i class="fa-solid fa-check"></i>
                    <p class="textLink">Concluídas</p>
            </a>
        </div>
        <a class="logoutArea" href="index.php?route=logout" >
            <i class="fa-solid fa-right-from-bracket" id="iconLogout"></i>
            <p class="textLogout">Sair</p>
        </a>
    </aside> 
<?php }

?>