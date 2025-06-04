/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*.{php,html,js}"],
  theme: {
    extend: {
      fontFamily: {
        'poppins': ['Poppins', 'sans-serif'],
        'greatVibes': ['Great Vibes', 'cursive'],
      },
      colors:{
        background : '#EFE1E1',
        colorText: '#74583E',
      }
    },
  },
  plugins: [],
}
