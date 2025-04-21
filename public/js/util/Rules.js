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
    phone: {
        test: (val) => {
            const cleaned = val.replace(/[\s\-().]/g, '');
            return /^[+]?[\d\s\-().]{6,20}$/.test(val) && cleaned.replace(/^\+/, '').match(/\d/g).length >= 6;
        },
        success: "✅ Numéro de téléphone valide.",
        error: "❌ Numéro invalide. Minimum 6 chiffres requis.",
    },
};
