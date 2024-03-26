<?php
require_once ('./backend/helper.php');

?>

<style>
    body {
        margin: 0;
        padding: 0;
    }


    /* 123 */

    .progress-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .progress {
        color: #6c757d;
    }

    .progress-bar {
        height: 20px;
        border-radius: 10px;
        overflow: hidden;
        border: 2px solid #000;
        margin: auto;
    }

    /* 456 */

    .header {
        background-color: red;
        width: 100%;
        height: 50px;
        position: fixed;
        top: 0;
        left: 0;
        display: flex;
        /* justify-content: space-between; */
        align-items: center;
        padding: 0 20px;
        box-sizing: border-box;
        z-index: 20;
    }

    .header .user-icon {
        position: relative;
    }

    .header .user-icon-button {
        background-color: transparent;
        border: none;
        cursor: pointer;
        padding: 0;
        margin: 0;
        outline: none;
    }

    .header .user-icon-button svg {
        width: 24px;
        height: 24px;
        fill: none;
        stroke: #fff;
    }

    .header #heading-text {
        padding: 10px;
        font-size: 24px;
        color: white;
    }

    /* .header .user-icon-button:focus+.user-menu,
    .header .user-menu:not(:empty):hover {
        display: block;
    } */

    .header .user-menu {
        display:
            <?php echo getCSSUserMenuDisplay(); ?>
        ;
        position: absolute;
        top: 50px;
        left: 0;
        width: 250px;
        background-color: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
        padding: 20px;
        box-sizing: border-box;
        z-index: 30;
    }

    .header .user-menu form {
        display: flex;
        flex-direction: column;
    }

    .header .user-menu label {
        margin-bottom: 10px;
    }

    .header .user-menu input[type="text"],
    .header .user-menu input[type="email"],
    .header .user-menu input[type="password"] {
        padding: 5px;
        margin-bottom: 10px;
    }

    .header .user-menu button {
        padding: 5px 10px;
        width: 100%;
        background-color: blue;
        color: white;
        border: none;
        cursor: pointer;
    }

    .header .user-menu button:focus {
        background-color: darkblue;
    }

    .header .user-menu .menu-form {
        display: none;
    }

    .header .user-menu .menu-form.active {
        display: block;
    }

    .nav {
        background-color: #f2f2f2;
        width: 100%;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: fixed;
        top: 0px;
        z-index: 10;
    }

    .nav a {
        text-decoration: none;
        color: black;
        padding: 10px;
        margin: 0 10px;
        border-radius: 5px;
    }

    .nav a:hover {
        background-color: #ddd;
    }

    .user-menu {
        z-index: 10;
    }

    .main {
        padding: 100px 0;
    }

    .profession-heading {
        text-align: center;
        font-size: 3rem;
        margin-bottom: 50px;
    }

    .profession-boxes {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
    }

    .profession-box {
        width: 300px;
        height: 400px;
        background-color: #f2f2f2;
        margin: 0 20px 20px 0;
        padding: 20px;
        box-sizing: border-box;
        text-align: center;
        position: relative;
    }

    .profession-box h2 {
        margin-bottom: 20px;
    }

    .pvc-button,
    /* .button {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #4CAF50;
        color: white;
        padding: 5px 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    } */
    .button {
        margin: 0 5px;
        background-color: #4CAF50;
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 15px;
        min-height: 30px;
        min-width: 120px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .pvc-button:active,
    .button:active {
        background-color: #4CAF50;
    }

    .button-container {
        display: flex;
        justify-content: center;
        align-items: center;
        /* margin: 50px; */
    }

    .rate-button {
        position: relative;
        bottom: 0px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #4CAF50;
        color: white;
        padding: 5px 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .pvc-button:focus+.pvc-list {
        display: block;
    }

    .pvc-list {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        background-color: #fff;
        border: 1px solid #ccc;
        z-index: 10;
    }

    .pvc-list dd {
        padding: 5px;
    }

    .window {
        display:
            none;
        position: fixed;
        z-index: 11;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .window-content {
        background-color: #ddd;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #ddd;
        width: 100%;
        max-width: 800px;
    }

    .close-rate-windows {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close-rate-windows:hover,
    .close-rate-windows:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    .window-header {
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .window-body {
        margin-bottom: 20px;
    }

    .pig-list {
        display: flex;
        flex-direction: column;
        margin-top: 20px;
    }

    .piq_item,
    .piq_control_item {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        border-radius: 1px;
        border-color: #000;
        background-color: #fff;
        padding: 10px;
        font-size: large;
    }

    .piq_control_item input.piq_imp {
        flex: 1;
        text-align: left;
    }

    .piq_control_item p.piq_imp_text {
        flex: 1;
        text-align: left;
    }

    .piq_item input[type="checkbox"] {
        margin-right: 10px;
    }

    .piq_controls {
        display: flex;
        align-items: center;
    }

    .piq_up,
    .piq_down {
        background-color: transparent;
        border: none;
        cursor: pointer;
        font-size: 16px;
        margin-left: 10px;
    }

    .piq_up:hover,
    .piq_down:hover {
        color: #333;
    }
</style>