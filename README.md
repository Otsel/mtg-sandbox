# mtg-sandbox
A modernized Magic: the Gathering play-testing environment!

## How to Run Locally

MTG:Sandbox runs using browser-sync. Install with:
```
npm install browser-sync

```

Or to run globally,
```
npm install -g browser-sync
```

Once those dependencies are installed, run the following:
```
npm run dev
```

This runs a script called "dev", which can be found in package.json, which opens a listen server that watches for changes to the compiled stylesheet `src/styles/main.css` and will display updated changes in your browser in real time.

## How to edit stylesheets

MTG:Sandbox is precompiled in SCSS for efficiency, so you'll need to compile `src/styles/main.scss' locally using your plugin of choice. Sorry! ┐(￣ヮ￣)┌
