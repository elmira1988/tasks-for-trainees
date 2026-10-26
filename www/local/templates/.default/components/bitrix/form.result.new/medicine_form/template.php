<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @var array $arResult
 */

// Собираем поля, которые мы будем рендерить в цикле верстки, и скрытые поля
$groupedFields = [
    'not_textarea' => [],
    'textarea' => [],
    'hidden' => [],
];

foreach ($arResult['QUESTIONS'] as $fieldSid => $arQuestion) {
    $firstStructure = reset($arQuestion['STRUCTURE']);
    $fieldType = $firstStructure['FIELD_TYPE'] ?? 'text';

    if ($fieldType === 'textarea') {
        $groupedFields['textarea'][$fieldSid] = $arQuestion;
    } elseif ($fieldType === 'hidden') {
        $groupedFields['hidden'][$fieldSid] = $arQuestion; // Скрытые поля улетают в свою корзину
    } else {
        $groupedFields['not_textarea'][$fieldSid] = $arQuestion;
    }
}



// Вывод сообщения об успешной отправке формы
if (!empty($arResult['FORM_NOTE'])) {
    echo $arResult['FORM_NOTE'];
}

// Если форма еще не отправлена
if ($arResult['isFormNote'] !== 'Y') { ?>

    <div class="contact-form">
        <div class="contact-form__head">
            <div class="contact-form__head-title">Связаться</div>
            <div class="contact-form__head-text">
                Наши сотрудники помогут выполнить подбор услуги и расчет цены с учетом ваших требований
            </div>
        </div>

        <?php echo $arResult['FORM_HEADER']; ?>

        <div class="contact-form__form">
            <?php
            // Фиксированный порядок вывода групп полей
            foreach (['not_textarea', 'textarea'] as $groupKey) {
                $fields = $groupedFields[$groupKey] ?? [];
                if (empty($fields)) {
                    continue;
                }

                $isTextareaGroup = ($groupKey === 'textarea');
                $groupWrapperClass = $isTextareaGroup ? 'contact-form__form-message' : 'contact-form__form-inputs d-flex';
                ?>

                <div class="<?php echo $groupWrapperClass; ?>">
                    <?php foreach ($fields as $fieldSid => $arQuestion) { ?>
                        <?php
                        $firstStructure = reset($arQuestion['STRUCTURE']);
                        $systemId = 'form_' . $firstStructure['FIELD_TYPE'] . '_' . $firstStructure['ID'];

                        $hasError = isset($arResult['FORM_ERRORS'][$fieldSid]);

                        $inputWrapperClass = $isTextareaGroup ? 'input' : 'input contact-form__input';
                        ?>

                        <div class="<?php echo $inputWrapperClass; ?>">
                            <label class="input__label" for="<?php echo htmlspecialcharsbx($systemId); ?>">
                                <div class="input__label-text">
                                    <?php echo $arQuestion['CAPTION']; ?>
                                    <?php if ($arQuestion['REQUIRED'] === 'Y') { ?>
                                        <span class="input__required-star">
                                            <?php echo strip_tags($arResult['REQUIRED_SIGN']); ?>
                                        </span>
                                    <?php } ?>
                                </div>

                                <?php echo $arQuestion["HTML_CODE"]; ?>

                                <div class="input__notification <?php echo $hasError ? 'is-active' : ''; ?>">
                                    <?php echo $hasError ? $arResult['FORM_ERRORS'][$fieldSid] : ''; ?>
                                </div>
                            </label>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>

            <div class="contact-form__bottom">
                <div class="contact-form__bottom-policy">
                    Нажимая «Отправить», Вы подтверждаете, что ознакомлены, полностью согласны и принимаете условия «Согласия на обработку персональных данных».
                </div>

                <?php
                $isButtonDisabled = (intval($arResult["F_RIGHT"]) < 10) ? 'disabled="disabled"' : '';
                $buttonTitle = htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]));

                if (empty($buttonTitle)) {
                    $buttonTitle = "Оставить заявку";
                }
                ?>

                <button class="form-button contact-form__bottom-button"
                        type="submit"
                        name="web_form_submit"
                        value="Y"
                    <?php echo $isButtonDisabled; ?>
                        data-success="Отправлено"
                        data-error="Ошибка отправки">
                    <div class="form-button__title"><?php echo $buttonTitle; ?></div>
                </button>
            </div>
        </div>

        <?php
        // ВЫВОД СКРЫТЫХ ПОЛЕЙ
        if (!empty($groupedFields['hidden'])) {
            echo implode('', array_column($groupedFields['hidden'], 'HTML_CODE'));
        }
        ?>
        <?php echo $arResult['FORM_FOOTER']; ?>
    </div>
<?php } ?>
