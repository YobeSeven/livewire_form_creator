<div>
    <form wire:submit.prevent="store">
        <div>
            <label for="name">Nom du formulaire:</label>
            <input type="text" wire:model="name" id="name" placeholder="Nom du formulaire" required>
        </div>

        <div>
            <label for="user">Utilisateur:</label>
            <input type="text" wire:model="user" id="user" placeholder="Nom d'utilisateur" required>
        </div>

        <button type="submit">Créer le formulaire</button>
    </form>
</div>
