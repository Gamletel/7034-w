<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align = (isset($block['align']) && !empty($block['align'])) ? 'align' . $block['align'] : '';

$block_title = $args['block_title'] ?? get_field('block_title');
$qas = $args['qas'] ?? get_field('qas');
$qasPerLoad = 5;
?>
<?php if (!empty($qas)) { ?>
    <div id="qas-block" class="block-margin <?= $classes; ?> <?= $align; ?>">
        <?php if ($block_title) { ?>
            <h2 class="block-title"><?= $block_title; ?></h2>
        <?php } ?>

        <div class="qas">
            <?php $qasAmount = count($qas) - 1;
            foreach ($qas as $key => $qa) {
                $question = $qa['question'];
                $answer = $qa['answer'];
                ?>
                <div class="qa <?php if($key >= $qasPerLoad){echo 'was-hidden';} ?>" <?php if ($key >= $qasPerLoad) {
                    echo 'style="display:none;"';
                } ?>>
                    <div class="question">
                        <div class="question__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"
                                 fill="none">
                                <path d="M11.6724 19.987C12.6983 22.9068 15.4798 25 18.7502 25C20.2261 25 21.6022 24.5737 22.7625 23.8374L24.3526 24.3675C24.9633 24.571 25.2691 24.6729 25.4721 24.6005C25.6488 24.5374 25.7876 24.3984 25.8506 24.2216C25.923 24.0186 25.8215 23.7133 25.6179 23.1026L25.0879 21.5125L25.2654 21.218C25.8922 20.1221 26.2505 18.8529 26.2505 17.5C26.2505 13.3579 22.8921 10 18.75 10L18.4692 10.0052L18.3276 10.0127M11.2501 20.0001C9.77419 20.0001 8.39788 19.5738 7.23755 18.8376L5.64758 19.3676C5.0369 19.5712 4.73125 19.6729 4.5282 19.6005C4.3515 19.5374 4.21226 19.3984 4.14925 19.2216C4.07684 19.0186 4.17876 18.7132 4.38232 18.1026L4.91236 16.5125C4.17617 15.3521 3.75 13.9759 3.75 12.5C3.75 8.35786 7.10786 5 11.25 5C15.3921 5 18.75 8.35786 18.75 12.5C18.75 16.6421 15.3922 20.0001 11.2501 20.0001Z"
                                      stroke="#3679F3" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
                        </div>

                        <h5 class="question__title">
                            <?= $question; ?>
                        </h5>

                        <div class="question__btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="6" viewBox="0 0 10 6"
                                 fill="none">
                                <path d="M9 1L5 5L1 1" stroke="var(--Card)" stroke-width="1.5"
                                      stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>

                    <div class="answer">
                        <div class="answer__text text-block p2">
                            <?= $answer; ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <?php if ($qasAmount >= $qasPerLoad) { ?>
            <div class="loadmore btn invert">Больше вопросов</div>
        <?php } ?>
    </div>
<?php } ?>
