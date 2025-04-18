<div id="modalAdd" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2>Ajouter un utilisateur</h2>
        </div>
        <div class="modal-body">
            <form id="addUser">
                <input type="text" name="username" id="username">
                <input type="email" name="email" id="email">
                <input type="password" name="password" id="password">
                <select name="role" id="role">
                    <option value="user">Utilisateur</option>
                    <option value="admin">Administrateur</option>
                </select>
                <div>
                    <button type="submit" class="btnVaild">Ajouter</button>
                </div>
                <div class="error"></div>
            </form>
        </div>
    </div>
</div>