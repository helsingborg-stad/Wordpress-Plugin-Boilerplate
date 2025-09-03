import { createViteConfig } from 'vite-config-factory'

const entries = {
    'js/{{BPREPLACESLUG}}': './source/js/{{BPREPLACESLUG}}.ts',
    'css/{{BPREPLACESLUG}}': './source/sass/{{BPREPLACESLUG}}.scss',
}

export default createViteConfig(entries, {
    outDir: 'dist',
    manifestFile: 'manifest.json',
})
