<!-- Information sur l'utilisateur si connecté, sinon bouton de login -->
<div class="float-right">
  <ul class="list-inline">
    <li class="list-inline-item"><?= $user['name']?></li>
    <li class="list-inline-item"><?= $user['email']?></li>
    <li class="list-inline-item">
      <form action="/web/auth/logout" method="post">
        <input type="submit" value="Logout">
      </form>
    </li>
  </ul>
</div>
