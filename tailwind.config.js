/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./templates/**/*.html.twig", "./vendor/symfony/twig-bridge/Resources/views/Form/tailwind_2_layout.html.twig"],
  theme: {
    extend: {},
  },
  plugins: [require("daisyui")],
}
