<div id="modalAdd" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2>Ajouter un utilisateur</h2>
        </div>
        <div class="modal-body">
            <form id="addUser">
                <input type="text" name="username" id="username" placeholder="username">
                <span class="response"></span>
                <input type="email" name="email" id="email" placeholder="email">
                <span class="response"></span>
                <input type="text" name="phone" id="phone" placeholder="phone">
                <span class="response"></span>
                <input type="password" name="password" id="password" placeholder="password">
                <span class="response"></span>
                <select name="role" id="role">
                    <option value="user">Utilisateur</option>
                    <option value="admin">Administrateur</option>
                </select>
                <span class="response"></span>
                <div>
                    <button type="submit" class="btnVaild" id="submit">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>