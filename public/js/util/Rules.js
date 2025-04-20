// rules.js
export const rules = {
    username: {
        test: (val) => val.length >= 3 && val.length <= 20,
        success: "✅ Nom d'utilisateur valide.",
        error: "❌ Doit contenir entre 3 et 20 caractères.",
    },
    email: {
        test: (val) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val),
        success: "✅ Email valide.",
        error: "❌ Format d'email invalide.",
    },
    password: {
        test: (val) => val.length >= 8,
        success: "✅ Mot de passe valide.",
        error: "❌ Minimum 8 caractères.",
    },
    role: {
        test: (val) => val === "user" || val === "admin",
        success: "✅ Rôle valide.",
        error: "❌ Rôle invalide.",
    },
};
