Misc Sound files
================

One of the default hooks is `misc/playSuccess` - it plays a random success sound effect whenever
you commit. There's an automatic (i.e. always turned on) call to `misc/playFail` if an operation
does not succeed (any operation that triggers the one-hook, not just committing) - by default
however no fail sound effects are present, it won't do anything.

Only one sound effect for success is provided in the repo. If you want to have random sound
just populate the `misc/success` folder with whatever sounds you'd like to hear and one will be
chosen at random to play when you successfully commit.

Same for failure sound effects - populate `misc/fail` with any sounds you'd like to use as your
pool of FALE noises. Or leave empty to hear the sound of silence
