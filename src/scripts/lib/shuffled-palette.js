export class ShuffledPallete {
  pointer = 0;

  constructor(colors) {
    this.collection = colors;
  }

  shuffle() {
    this.collection.sort(() => Math.random() - 0.5);
  }

  get next() {
    return this.collection[++this.pointer % this.collection.length];
  }
}
