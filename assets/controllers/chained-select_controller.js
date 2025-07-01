import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['masterSelect', 'childSelect'];
    static values = {
        childSelectUrl: String,
        locale: String,
        childSelected: String,
    };

    connect() {
        this.onMasterChange();
    }

    async onMasterChange() {
        console.log('Master Change value: ' + this.masterSelectTarget.value);
        console.log( 'Child selected option: ' + this.childSelectedValue);
        const url = this.childSelectUrlValue + '?' + new URLSearchParams({ id: this.masterSelectTarget.value }).toString();
        try {
            const response =  await fetch(url);
            const arrazoiak = await response.json();
            const select = this.childSelectTarget;
            select.replaceChildren();
            this.addOption(select,'','');
            arrazoiak.forEach(arrazoia => {
                let textContent = this.localeValue == 'es' ? arrazoia.maila_es: arrazoia.maila_eu;
                this.addOption(select,arrazoia.id,textContent);
            });
            if (this.childSelectedValue != '' ) {
                select.value = this.childSelectedValue;
            }
        } catch (error) {
            console.error('Error cargando opciones del select:', error);
        }
    }

    addOption(select, value, text) {
        const option = document.createElement("option");
        option.value = value;
        option.textContent = text;
        select.appendChild(option);
    }
}
