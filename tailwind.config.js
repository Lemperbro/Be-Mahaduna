/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js"
  ],
  daisyui: {
    themes: [],
  },
  theme: {
    extend: {
      colors:{
        Sidebar: "#001D22",
        Sidebar2 : "#002930",
        SidebarActive: "#143136",
        main: "#F0F7F4",
        main2: "#263F43",
        main3: "#b5c7c2",
        main4: "#cadbd6",
        main5: "#000d0f",
        main6: "#003640",
        main7: "#fafaf0"
      },
      boxShadow :{
        shadow1 : "rgba(0, 0, 0, 0.24) 0px 3px 8px"
      }
    },
  },
  plugins: [
    require('flowbite/plugin'),
    require("daisyui"),
    require('@tailwindcss/line-clamp'),
  ],
}

