import { Controller } from "@hotwired/stimulus";

export default class extends Controller {
    static values = {
        name: String,
    };

    add() {
        window.dispatchEvent(
            new CustomEvent("sonner", {
                detail: {
                    type: "success",
                    title: "Ajouté au panier",
                    description: this.nameValue,
                },
            }),
        );
    }
}
