/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./templates/**/*.html.twig", "./vendor/symfony/twig-bridge/Resources/views/Form/tailwind_2_layout.html.twig"],
  theme: {
    extend: {},
    fontFamily: {
      sans: [
        'ui-sans-serif',
        'system-ui',
        '-apple-system',
        'BlinkMacSystemFont',
        '"Segoe UI"',
        'Roboto',
        '"Helvetica Neue"',
        'Arial',
        '"Noto Sans"',
        'sans-serif',
        '"Apple Color Emoji"',
        '"Segoe UI Emoji"',
        '"Segoe UI Symbol"',
        '"Noto Color Emoji"',
      ],
      serif: ['ui-serif', 'Georgia', 'Cambria', '"Times New Roman"', 'Times', 'serif'],
    }
  },
  plugins: [require("daisyui")],
}
